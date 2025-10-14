<?php

namespace Modules\Service\Http\Controllers\Web\Admin\CategoryManagement;

use App\CentralLogics\Helpers;
use App\Models\Translation;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Exports\CategoryExport;
use Symfony\Component\HttpFoundation\StreamedResponse;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Config;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ServiceManagement\Variation;

class CategoryController extends Controller
{

    private Variation $variation;
    private Zone $zone;
    private Category $category;

    use AuthorizesRequests;

    public function __construct(Category $category, Zone $zone, Variation $variation)
    {
        $this->category = $category;
        $this->zone = $zone;
        $this->variation = $variation;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request): View|Factory|Application
    {
        $search = $request->has('search') ? $request['search'] : '';
        $status = $request->has('status') ? $request['status'] : 'all';
        $queryParams = ['search' => $search, 'status' => $status];

        $categories = $this->category->withCount(['children', 'zones' => function ($query) {
            $query->withoutGlobalScope('translate');
        }])
            ->where('module_id', $this->currentModuleId())
            ->when($request->filled('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                $query->where(function ($q) use ($keys) {
                    foreach ($keys as $key) {
                        $q->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($status != 'all', function ($query) use ($status) {
                $query->ofStatus($status == 'active' ? 1 : 0);
            })
            ->ofType('main')
            ->latest()->paginate(pagination_limit())->appends($queryParams);

        $zones = $this->zone->active()->withoutGlobalScope('translate')->get();

        $language = getWebConfig('language');

        return view('service::admin.category-management.create', compact('categories', 'zones', 'search', 'status', 'language'));
    }

    public function getTable(Request $request)
    {
        $status = $request->input('status', 'all');
        $search = $request->input('search', '');
        $page = $request->input('page', 1);
        $queryParams = ['search' => $search, 'status' => $status];

        $categories = $this->category->withCount(['children', 'zones' => function ($query) {
            $query->withoutGlobalScope('translate');
        }])
            ->when($search, function ($query) use ($search) {
                $keys = explode(' ', $search);
                foreach ($keys as $key) {
                    $query->orWhere('name', 'LIKE', "%$key%");
                }
            })
            ->when($status != 'all', function ($query) use ($status) {
                $query->ofStatus($status == 'active' ? 1 : 0);
            })
            ->ofType('main')
            ->latest()
            ->paginate(pagination_limit())
            ->appends($queryParams);

        $totalCategory = $categories->total();
        $categories->withPath(route('admin.service.category.create'));

        // Fallback logic: If current page has no data, go back one page
        if ($categories->isEmpty() && $page > 1) {
            $page = $page - 1;
            $request->merge(['page' => $page]);

            $categories = $this->category->withCount(['children', 'zones' => function ($query) {
                $query->withoutGlobalScope('translate');
            }])
                ->when($search, function ($query) use ($search) {
                    $keys = explode(' ', $search);
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', "%$key%");
                    }
                })
                ->when($status != 'all', function ($query) use ($status) {
                    $query->ofStatus($status == 'active' ? 1 : 0);
                })
                ->ofType('main')
                ->latest()
                ->paginate(pagination_limit())
                ->appends($queryParams);
        }

        return response()->json([
            'view' =>  view('service::admin.category-management.partials._table', compact('categories', 'search', 'status', 'totalCategory'))->render(),
            'totalCategory' => $totalCategory,
            'offset' => ($categories->currentPage() - 1) * $categories->perPage(),
            'page' => $categories->currentPage(),
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:service_categories',
            'name.0' => 'required',
            'zone_ids' => 'required|array',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10240',
        ],
            [
                'name.0.required' => translate('default_name_is_required'),
            ]);

        $category = $this->category;
        $category->module_id = $this->currentModuleId();
        $category->name = $request->name[array_search('default', $request->lang)];
        $category->image = file_uploader('category/', 'png', $request->file('image'));
        $category->parent_id = 0;
        $category->position = 1;
        $category->description = null;
        $category->save();
        $category->zones()->sync($request->zone_ids);

        $defaultLanguage = str_replace('_', '-', app()->getLocale());

        $data = [];

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->name,
            model_class: true
        );

        Toastr::success(translate(CATEGORY_STORE_200['message']));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return View|Factory|Application|RedirectResponse
     * @throws AuthorizationException
     */
    public function edit(string $id): View|Factory|Application|RedirectResponse
    {
        $category = $this->category->withoutGlobalScope('translate')->with(['zones' => function ($query) {
            $query->withoutGlobalScope('translate');
        }])->ofType('main')->where('id', $id)->first();
        if (isset($category)) {
            $zones = $this->zone->active()->withoutGlobalScope('translate')->get();
            $language = getWebConfig('language');
            return view('service::admin.category-management.edit', compact('category', 'zones', 'language'));
        }

        Toastr::error(translate(DEFAULT_204['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     * @return JsonResponse|RedirectResponse
     */
    public function update(Request $request, string $id): JsonResponse|RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:service_categories,name,' . $id,
            'name.0' => 'required',
            'zone_ids' => 'required|array',
        ],
            [
                'name.0.required' => translate('default_name_is_required'),
            ]);

        $category = $this->category->ofType('main')->where('id', $id)->first();
        if (!$category) {
            return response()->json(response_formatter(CATEGORY_204), 204);
        }
        $category->name = $request->name[array_search('default', $request->lang)];
        if ($request->has('image')) {
            $category->image = file_uploader('category/', 'png', $request->file('image'), $category->image);
        }
        $category->parent_id = 0;
        $category->position = 1;
        $category->description = null;
        $category->save();

        $category->zones()->sync($request->zone_ids);

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->name,
            model_class: true
        );

        Toastr::success(translate(CATEGORY_UPDATE_200['message']));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $category = $this->category->ofType('main')->where('id', $id)->first();
        if (isset($category)) {
            file_remover('category/', $category->image);
            $category->zones()->sync([]);
            $category->translations()->delete();
            $category->delete();
            Toastr::success(translate(CATEGORY_DESTROY_200['message']));
            return back();
        }
        Toastr::success(translate(CATEGORY_204['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function statusUpdate(Request $request, $id): RedirectResponse
    {
        $category = $this->category->where('id', $id)->first();
        $this->category->where('id', $id)->update(['is_active' => !$category->is_active]);
        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function featuredUpdate(Request $request, $id): RedirectResponse
    {
        $category = $this->category->where('id', $id)->first();
        $this->category->where('id', $id)->update(['is_featured' => !$category->is_featured]);

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function childes(Request $request): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:all,active,inactive',
            'id' => 'required|uuid'
        ]);

        $childes = $this->category->where('module_id', $this->currentModuleId())->when($request['status'] != 'all', function ($query) use ($request) {
            return $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
        })->ofType('sub')->with(['zones'])->where('parent_id', $request['id'])->orderBY('name', 'asc')->paginate(pagination_limit());

        return response()->json(response_formatter(DEFAULT_200, $childes), 200);
    }

    /**
     * Display a listing of the resource.
     * @param $id
     * @return JsonResponse
     */
    public function ajaxChildes(Request $request, $id): JsonResponse
    {
        $categories = $this->category->where('module_id', $this->currentModuleId())->ofStatus(1)->ofType('sub')->where('parent_id', $id)->orderBY('name', 'asc')->get();
        $category = $this->category->where('id', $id)->with(['zones'])->first();
        $zones = $category->zones;

        session()->put('category_wise_zones', $zones);

        $variants = $this->variation->where(['service_id' => $request['service_id']])->get();

        return response()->json([
            'template' => view('service::admin.category-management.partials._childes-selector', compact('categories'))->render(),
            'template_for_zone' => view('service::admin.service-management.partials._category-wise-zone', compact('zones'))->render(),
            'template_for_variant' => view('service::admin.service-management.partials._variant-data', compact('zones'))->render(),
            'template_for_update_variant' => view('service::admin.service-management.partials._update-variant-data', compact('zones', 'variants'))->render()
        ], 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function ajaxChildesOnly(Request $request, $id): JsonResponse
    {
        $categories = $this->category->where('module_id', $this->currentModuleId())->ofStatus(1)->ofType('sub')->where('parent_id', $id)->orderBY('name', 'asc')->get();
        $subCategoryId = $request->sub_category_id ?? null;

        return response()->json([
            'template' => view('categorymanagement::admin.partials._childes-selector', compact('categories', 'subCategoryId'))->render()
        ], 200);
    }


    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return string|StreamedResponse
     */
    public function download(Request $request)
    {
        $search = $request->has('search') ? $request['search'] : '';
        $status = $request->has('status') ? $request['status'] : 'all';

        $categories = $this->category->withCount(['children', 'zones' => function ($query) {
            $query->withoutGlobalScope('translate');
        }])
            ->where('module_id', $this->currentModuleId())
            ->when($request->filled('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                $query->where(function ($q) use ($keys) {
                    foreach ($keys as $key) {
                        $q->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($status != 'all', function ($query) use ($status) {
                $query->ofStatus($status == 'active' ? 1 : 0);
            })
            ->ofType('main')
            ->latest()
            ->get();

        $fileName = 'categories.xlsx';

        return Excel::download(new CategoryExport([
            'categories' => $categories,
            'search' => $search,
            'status' => $status,
        ]), $fileName);
    }
}

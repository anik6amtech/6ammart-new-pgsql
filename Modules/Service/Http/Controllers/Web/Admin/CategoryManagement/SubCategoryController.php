<?php

namespace Modules\Service\Http\Controllers\Web\Admin\CategoryManagement;

use App\CentralLogics\Helpers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Exports\SubCategoryExport;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\CategoryManagement\Category;

class SubCategoryController extends Controller
{

    private Category $category;
    // private SubscribedService $subscribedService;

    public function __construct(Category $category) //, SubscribedService $subscribedService
    {
        $this->category = $category;
        // $this->subscribedService = $subscribedService;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request): Renderable
    {

        $search = $request->has('search') ? $request['search'] : '';
        $status = $request->has('status') ? $request['status'] : 'all';
        $queryParams = ['search' => $search, 'status' => $status];

        $subCategories = $this->category->withCount('services')->with(['parent'])
            ->where('module_id', $this->currentModuleId())
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($status != 'all', function ($query) use ($request) {
                return $query->ofStatus(($request['status'] == 'active') ? 1 : 0);
            })
            ->ofType('sub')->latest()->paginate(pagination_limit())->appends($queryParams);

        $mainCategories = $this->category->ofType('main')->orderBy('name')->get(['id', 'name']);
        $language = getWebConfig('language');

        return view('service::admin.category-management.sub-category.create', compact('subCategories', 'mainCategories', 'status', 'search', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:service_categories',
            'name.0' => 'required',
            'parent_id' => 'required',
            'short_description' => 'required',
            'short_description.0' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif|max:10240',
        ],
            [
                'name.0.required' => translate('default_name_is_required'),
                'short_description.0.required' => translate('default_short_description_is_required'),
            ]);

        $category = $this->category;
        $category->module_id = $this->currentModuleId();
        $category->name = $request->name[array_search('default', $request->lang)];
        $category->image = file_uploader('category/', 'png', $request->file('image'));
        $category->parent_id = $request['parent_id'];
        $category->position = 2;
        $category->description = $request->short_description[array_search('default', $request->lang)];
        $category->save();

        $defaultLanguage = str_replace('_', '-', app()->getLocale());

        Helpers::add_or_update_translations(
            request: $request,
            key_data: 'name',
            name_field: 'name',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->name,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data: 'description',
            name_field: 'short_description',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->description,
            model_class: true
        );

        Toastr::success(translate(CATEGORY_STORE_200['message']));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View|RedirectResponse
     */
    public function edit(string $id): View|Factory|RedirectResponse|Application
    {
        $subCategory = $this->category->withoutGlobalScope('translate')->ofType('sub')->where('id', $id)->first();
        if (isset($subCategory)) {
            $mainCategories = $this->category->ofType('main')->orderBy('name')->get(['id', 'name']);
            $language = getWebConfig('language');

            return view('service::admin.category-management.sub-category.edit', compact('subCategory', 'mainCategories', 'language'));
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
            'parent_id' => 'required',
            'short_description' => 'required',
            'short_description.0' => 'required',
        ],
            [
                'name.0.required' => translate('default_name_is_required'),
                'short_description.0.required' => translate('default_short_description_is_required'),
            ]
        );

        $category = $this->category->ofType('sub')->where('id', $id)->first();
        if (!$category) {
            return response()->json(response_formatter(CATEGORY_204), 204);
        }
        $category->name = $request->name[array_search('default', $request->lang)];
        if ($request->has('image')) {
            $category->image = file_uploader('category/', 'png', $request->file('image'), $category->image);
        }
        $category->parent_id = $request['parent_id'];
        $category->position = 2;
        $category->description = $request->short_description[array_search('default', $request->lang)];
        $category->save();

        $defaultLanguage = str_replace('_', '-', app()->getLocale());

        Helpers::add_or_update_translations(
            request: $request,
            key_data: 'name',
            name_field: 'name',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->name,
            model_class: true
        );

        Helpers::add_or_update_translations(
            request: $request,
            key_data: 'description',
            name_field: 'short_description',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->description,
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
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $category = $this->category->where('id', $id)->ofType($this)->first();
        if ($category) {
            file_remover('category/', $category->image);
            DB::transaction(function () use ($category, $id) {
                $category->translations()->delete();
                $category->delete();
                // $this->subscribedService->where('sub_category_id', $id)->delete();
            });

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
        $category = $this->category->ofType('sub')->where('id', $id)->first();
        $this->category->where('id', $id)->update(['is_active' => !$category->is_active]);

        Toastr::success(translate(DEFAULT_STATUS_UPDATE_200['message']));
        return back();
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

        $subCategories = $this->category->withCount('services')
            ->with(['parent'])
            ->where('module_id', $this->currentModuleId())
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('name', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($status != 'all', function ($query) use ($status) {
                return $query->ofStatus($status == 'active' ? 1 : 0);
            })
            ->ofType('sub')
            ->latest()
            ->get();

        $fileName = 'sub-categories.xlsx';

        return Excel::download(new SubCategoryExport([
            'subCategories' => $subCategories,
            'search' => $search,
            'status' => $status,
        ]), $fileName);
    }

}

<?php

namespace Modules\Service\Http\Controllers\Web\Admin\PromotionManagement;

use App\CentralLogics\Helpers;
use App\Models\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Modules\Service\Entities\CategoryManagement\Category;
use Modules\Service\Entities\ServiceManagement\Service;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Service\Exports\BannerExport;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BannerController extends Controller
{
    private Banner $banner;
    private Category $category;
    private Service $service;


    public function __construct(Banner $banner, Category $category, Service $service)
    {
        $this->banner = $banner;
        $this->category = $category;
        $this->service = $service;
    }

    private function currentModuleId(): int
    {
        return Config::get('module.current_module_id');
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create(Request $request): View|Factory|Application
    {
        $search = $request->has('search') ? $request['search'] : '';
        $resourceType = $request->has('resource_type') ? $request['resource_type'] : 'all';
        $queryParam = ['search' => $search, 'resource_type' => $resourceType];

        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $services = $this->service->active()->latest()->get();
        // $services = [];

        $banners = $this->banner->with(['service', 'category'])
        // $banners = $this->banner->with(['category'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('title', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request->has('resource_type') && $request['resource_type'] != 'all', function ($query) use ($request) {
                return $query->where(['type' => $request['resource_type']]);
            })->whereIn('module_id', [Config::get('module.current_module_id')])->latest()->paginate(pagination_limit())->appends($queryParam);
        $language = getWebConfig('language');
        return view('service::admin.promotion-management.promotional-banners.create', compact('banners', 'services', 'categories', 'resourceType', 'search', 'language'));
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
            'banner_title' => 'required|max:190',
            'banner_title.0' => 'required',
            'resource_type' => 'required|in:service,category,redirect_link',
            'banner_image' => 'required|image|max:10000|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key'))
        ]);

        $banner = $this->banner;
        $banner->title = $request->banner_title[array_search('default', $request->lang)];
        $banner->default_link = $request['redirect_link'];
        $banner->type = $request['resource_type'];
        if ($request['resource_type'] != 'redirect_link') {
            $resourceId = $request['resource_type'] == 'service' ? $request['service_id'] : $request['category_id'];
        } else {
            $resourceId = null;
        }
        $banner->data = $resourceId??0;
        $banner->image = file_uploader('banner/', 'png', $request->file('banner_image'));
        $banner->status = 1;
        $banner->module_id = $this->currentModuleId();
        $banner->zone_id = 1;
        $banner->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'title',
            name_field:'banner_title',
            model_name: get_class($banner),
            data_id: $banner->id,
            data_value: $banner->title,
            model_class: true
        );

        Toastr::success(translate(BANNER_CREATE_200['message']));
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(string $id): View|Factory|Application
    {
        $banner = $this->banner->with(['service', 'category'])->where('id', $id)->first();
        $categories = $this->category->ofStatus(1)->ofType('main')->latest()->get();
        $services = $this->service->active()->latest()->get();
        
        $language = getWebConfig('language');
        return view('service::admin.promotion-management.promotional-banners.edit', compact('categories', 'services', 'banner', 'language'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'banner_title' => 'required|max:190',
            'banner_title.0' => 'required',
            'resource_type' => 'required|in:service,category,redirect_link',
            // 'banner_image' => 'required|image|max:10000|mimes:' . implode(',', array_column(IMAGEEXTENSION, 'key'))
        ]);

        $banner = $this->banner->where(['id' => $id])->first();
        $banner->title = $request->banner_title[array_search('default', $request->lang)];
        $banner->default_link = $request['redirect_link'];
        $banner->type = $request['resource_type'];
        if ($request['resource_type'] != 'redirect_link') {
            $resourceId = $request['resource_type'] == 'service' ? $request['service_id'] : $request['category_id'];
        } else {
            $resourceId = null;
        }
        $banner->data = $resourceId??1;
        $banner->image = file_uploader('banner/', 'png', $request->file('banner_image'), $banner->image);
        $banner->status = 1;
        $banner->module_id = $this->currentModuleId();
        $banner->zone_id = 1;
        $banner->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'title',
            name_field:'banner_title',
            model_name: get_class($banner),
            data_id: $banner->id,
            data_value: $banner->title,
            model_class: true
        );

        Toastr::success(translate(BANNER_UPDATE_200['message']));
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
        $banner = $this->banner->where('id', $id)->first();

        if (isset($banner)) {
            file_remover('banner/', $banner['image']);
            $this->banner->where('id', $id)->delete();
        }
        Toastr::success(translate(DEFAULT_DELETE_200['message']));
        return back();
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function statusUpdate(Request $request, $id): JsonResponse
    {
        $banner = $this->banner->where('id', $id)->first();
        $this->banner->where('id', $id)->update(['status' => !$banner->status]);

        return response()->json(response_formatter(DEFAULT_STATUS_UPDATE_200), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return string|StreamedResponse
     */
    public function download(Request $request)
    {
        $banners = $this->banner->with(['service', 'category'])
            ->when($request->has('search'), function ($query) use ($request) {
                $keys = explode(' ', $request['search']);
                return $query->where(function ($query) use ($keys) {
                    foreach ($keys as $key) {
                        $query->orWhere('title', 'LIKE', '%' . $key . '%');
                    }
                });
            })
            ->when($request->has('resource_type') && $request['resource_type'] != 'all', function ($query) use ($request) {
                return $query->where(['resource_type' => $request['resource_type']]);
            })
            ->whereIn('module_id', [Config::get('module.current_module_id')])
            ->latest()
            ->get();

        $fileName = 'banners.xlsx';
        $search = $request->input('search') ?? '';
        $resourceType = $request->input('resource_type') ?? 'all';

        return Excel::download(new BannerExport([
            'banners' => $banners,
            'search' => $search,
            'resource_type' => $resourceType,
        ]), $fileName);
    }
}

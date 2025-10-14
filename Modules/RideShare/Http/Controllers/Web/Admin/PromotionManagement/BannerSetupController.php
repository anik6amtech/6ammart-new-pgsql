<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\PromotionManagement;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\PromotionManagement\BannerSetupStoreUpdateRequest;
use Modules\RideShare\Interface\PromotionManagement\Service\BannerSetupServiceInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BannerSetupController extends BaseController
{
    protected $bannerSetupService;

    public function __construct(BannerSetupServiceInterface $bannerSetupService)
    {
        parent::__construct($bannerSetupService);
        $this->bannerSetupService = $bannerSetupService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        $criteria = $request?->all();
        $criteria['search_fields'] = ['title'];
        $criteria['module_id'] = Config::get('module.current_module_id');
        $banners = $this->bannerSetupService->index(criteria: $criteria, orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request['page']??1);
        $language = getWebConfig('language');
        return view('ride-share::admin.promotion-management.banner-setup.index', compact('banners', 'language'));
    }

    public function store(BannerSetupStoreUpdateRequest $request)
    {
        $this->bannerSetupService->create(data: $request);
        Toastr::success(BANNER_STORE_200['message']);
        return back();
    }

    public function edit($id)
    {
        $banner = $this->bannerSetupService->findOne(id: $id, withoutGlobalScope: ['translate']);
        $language = getWebConfig('language');
        return view('ride-share::admin.promotion-management.banner-setup.edit', compact('banner', 'language'));
    }

    public function update(BannerSetupStoreUpdateRequest $request, $id)
    {
        $this->bannerSetupService->update(id: $id, data: $request);
        Toastr::success(BANNER_UPDATE_200['message']);
        return back();
    }

    public function destroy($id)
    {
        $this->bannerSetupService->delete(id: $id);
        Toastr::success(BANNER_DESTROY_200['message']);
        return back();
    }

    public function status(Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'boolean'
        ]);
        $model = $this->bannerSetupService->statusChange(id: $request->id, data: $request->all());
        Toastr::success(BANNER_UPDATE_200['message']);
        return back();
        // return response()->json($model);
    }

    public function featured(Request $request): RedirectResponse
    {
        $request->validate([
            'featured' => 'boolean'
        ]);
        $model = $this->bannerSetupService->featuredChange(id: $request->id, data: $request->all());
        Toastr::success(BANNER_UPDATE_200['message']);
        return back();
    }


    public function trashed(Request $request): View
    {
        $banners = $this->bannerSetupService->trashedData(criteria: $request->all(), limit: paginationLimit(), offset: $request['page']??1);
        return view('ride-share::admin.promotion-management.banner-setup.trashed', compact('banners'));
    }

    public function restore($id): RedirectResponse
    {
        $this->bannerSetupService->restoreData(id: $id);

        Toastr::success(DEFAULT_RESTORE_200['message']);
        return redirect()->route('admin.promotion.banner-setup.index');

    }

    public function permanentDelete($id)
    {
        $this->bannerSetupService->permanentDelete(id: $id);
        Toastr::success(BANNER_DESTROY_200['message']);
        return back();
    }

    public function export(Request $request): View|Factory|Response|StreamedResponse|string|Application
    {
        $banner = $this->bannerSetupService->getBy(criteria: $request->all());
        $data = $banner->map(function ($item) {
            return [
                'id' => $item['id'],
                'banner_title' => $item['name'],
                "image" => $item['image'],
                'position' => $item['display_position'],
                'redirect_link' => $item['redirect_link'],
                "total_redirection" => $item['total_redirection'],
                "group" => $item['banner_group'],
                'time_period' => $item['time_period'] == ALL_TIME ? ALL_TIME : $item['start_date'] . ' To ' . $item['end_date'],
                "is_active" => $item['is_active'],
                "created_at" => $item['created_at'],
            ];
        });

        return exportData($data, $request['file'], 'ride-share::admin.promotion-management.banner-setup.print');
    }
}

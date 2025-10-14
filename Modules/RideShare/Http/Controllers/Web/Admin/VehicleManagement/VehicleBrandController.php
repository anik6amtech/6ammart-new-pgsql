<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\VehicleManagement;


use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\VehicleManagement\VehicleBrandStoreUpdateRequest;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleBrandServiceInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VehicleBrandController extends BaseController
{
    protected $vehicleBrandService;

    public function __construct(VehicleBrandServiceInterface $vehicleBrandService)
    {
        parent::__construct($vehicleBrandService);
        $this->vehicleBrandService = $vehicleBrandService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        // $brands = $this->vehicleBrandService->index(criteria: $request?->all(), relations: ['vehicles'], orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request['page']??1);
        $brands = $this->vehicleBrandService->index(criteria: $request?->all(), relations: [], orderBy: ['created_at' => 'desc'], limit: paginationLimit(), offset: $request['page']??1);
        $language = getWebConfig('language');
        return view('ride-share::admin.vehicle-management.brand.index', compact('brands', 'language'));
    }

    public function store(VehicleBrandStoreUpdateRequest $request): RedirectResponse
    {;
        $this->vehicleBrandService->create(data: $request);
        Toastr::success(ucfirst(BRAND_CREATE_200['message']));
        return back();

    }

    public function edit(string $id): Renderable
    {
        $brand = $this->vehicleBrandService->findOne(id: $id, withoutGlobalScope: ['translate']);
        $language = getWebConfig('language');
        return view('ride-share::admin.vehicle-management.brand.edit', compact('brand', 'language'));
    }

    public function update(VehicleBrandStoreUpdateRequest $request, string $id): RedirectResponse
    {
        $this->vehicleBrandService->update(id: $id, data: $request);
        Toastr::success(BRAND_UPDATE_200['message']);
        return redirect()->route('admin.ride-share.vehicle.attribute-setup.brand.index');

    }

    public function destroy(string $id): RedirectResponse
    {
        $this->vehicleBrandService->delete(id: $id);
        Toastr::success(BRAND_DELETE_200['message']);
        return redirect()->route('admin.ride-share.vehicle.attribute-setup.brand.index');
    }

    public function status(Request $request): RedirectResponse
    {
        $request->validate([
            'status' => 'boolean'
        ]);
        $model = $this->vehicleBrandService->statusChange(id: $request->id, data: $request->all());
        Toastr::success(BRAND_UPDATE_200['message']);
        return redirect()->route('admin.ride-share.vehicle.attribute-setup.brand.index');
        // return response()->json($model);
    }

    public function trashed(Request $request): View
    {
        $brands = $this->vehicleBrandService->getBy(criteria: $request->all(), limit: paginationLimit(), onlyTrashed: true);
        return view('ride-share::admin.vehicle-management..brand.trashed', compact('brands'));
    }

    public function restore($id): RedirectResponse
    {
        $this->vehicleBrandService->restoreData(id: $id);
        Toastr::success(DEFAULT_RESTORE_200['message']);
        return redirect()->route('admin.vehicle-management.vehicle.attribute-setup.brand.index');
    }

    public function permanentDelete($id)
    {
        $this->vehicleBrandService->permanentDelete(id: $id);
        Toastr::success(BRAND_DELETE_200['message']);
        return back();
    }

    public function getAllAjax(Request $request): JsonResponse
    {
        $brands = $this->vehicleBrandService->index(criteria: $request->all());
        $selectBrands = $brands->map(function ($items, $key) {
            return [
                'text' => $items->name,
                'id' => $items->id
            ];
        });
        return response()->json($selectBrands);
    }

    public function export(Request $request): View|Factory|Response|StreamedResponse|string|Application
    {
        /* relations: ['vehicles'] */
        $data = $this->vehicleBrandService->export(criteria: $request->all(), relations: [], orderBy: ['created_at' => 'desc']);
        return exportData($data, $request['file'], 'ride-share::admin.vehicle-management.brand.print');
    }

}

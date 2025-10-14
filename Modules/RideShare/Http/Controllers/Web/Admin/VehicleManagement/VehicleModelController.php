<?php

namespace Modules\RideShare\Http\Controllers\Web\Admin\VehicleManagement;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Modules\RideShare\Http\Controllers\BaseController;
use Modules\RideShare\Http\Requests\VehicleManagement\VehicleModelStoreUpdateRequest;
use Modules\RideShare\Interface\VehicleManagement\Service\VehicleModelServiceInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VehicleModelController extends BaseController
{

    protected $vehicleModelService;

    public function __construct(VehicleModelServiceInterface $vehicleModelService)
    {
        parent::__construct($vehicleModelService);
        $this->vehicleModelService = $vehicleModelService;
    }

    public function index(?Request $request, string $type = null): View|Collection|LengthAwarePaginator|null|callable|RedirectResponse
    {
        $relations = [];
        $models = $this->vehicleModelService->index(criteria: $request?->all(), relations: $relations, limit: paginationLimit(), offset: $request['page']??1);
        $language = getWebConfig('language');
        return view('ride-share::admin.vehicle-management.model.index', compact('models', 'language'));
    }

    public function store(VehicleModelStoreUpdateRequest $request): RedirectResponse
    {
        $this->vehicleModelService->create(data: $request);

        Toastr::success(MODEL_CREATE_200['message']);
        return back();
    }

    public function edit(string $id): Renderable
    {
        $relations = ['brand'];
        $model = $this->vehicleModelService->findOne(id: $id, relations: $relations, withoutGlobalScope: ['translate']);
        $language = getWebConfig('language');
        return view('ride-share::admin.vehicle-management.model.edit', compact('model', 'language'));
    }

    public function update(VehicleModelStoreUpdateRequest $request, string $id): RedirectResponse
    {
        $this->vehicleModelService->update(id: $id, data: $request);
        Toastr::success(MODEL_UPDATE_200['message']);
        return redirect()->route('admin.ride-share.vehicle.attribute-setup.model.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->vehicleModelService->delete(id: $id);
        Toastr::success(DEFAULT_DELETE_200['message']);
        return redirect()->route('admin.ride-share.vehicle.attribute-setup.model.index');
    }

    public function status(Request $request): RedirectResponse
    {
        $model = $this->vehicleModelService->statusChange(id: $request->id, data: $request->all());
        Toastr::success(MODEL_UPDATE_200['message']);
        return redirect()->route('admin.ride-share.vehicle.attribute-setup.model.index');
    }

    public function trashed(Request $request): View
    {
        $models = $this->vehicleModelService->getBy(criteria: $request->all(), limit: paginationLimit(), offset: $request['page']??1, onlyTrashed: true);
        return view('ride-share::admin.vehicle-management.model.trashed', compact('models'));
    }

    public function restore($id): RedirectResponse
    {
        $this->vehicleModelService->restoreData($id);
        Toastr::success(DEFAULT_RESTORE_200['message']);
        return redirect()->route('ride-share::admin.vehicle-management.model.index');

    }

    public function permanentDelete($id)
    {
        $this->vehicleModelService->permanentDelete(id: $id);
        Toastr::success(DEFAULT_DELETE_200['message']);
        return back();
    }

    public function ajax_models(Request $request, $brand_id): JsonResponse
    {
        $attributes = ['brand_id' => $brand_id, 'is_active' => 1];
        $models = $this->vehicleModelService->getBy(criteria: $attributes);
        return response()->json([
            'template' => view('ride-share::admin.partials._model-selector', compact('models'))->render(),
        ]);
    }


    public function ajax_models_child(Request $request, $brand_id): JsonResponse
    {
        $attributes = ['brand_id' => $brand_id, 'is_active' => 1];
        $models = $this->vehicleModelService->getBy(criteria: $attributes);
        $model_id = $request->model_id ?? null;

        return response()->json([
            'template' => view('vehiclemanagement::admin.partials._model-selector', compact('models', 'model_id'))->render()
        ]);
    }


    public function export(Request $request): View|Factory|Response|StreamedResponse|string|Application
    {
        /* relations: ['vehicles'] */
        $data = $this->vehicleModelService->export(criteria: $request->all(), relations: [], orderBy: ['created_at' => 'desc']);
        return exportData($data, $request['file'], 'ride-share::admin.vehicle-management.model.print');
    }

}

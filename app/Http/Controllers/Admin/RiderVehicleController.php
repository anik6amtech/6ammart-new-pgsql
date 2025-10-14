<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleStoreUpdateRequest;
use App\Models\RiderVehicle;
use App\Models\RiderVehicleCategory;
use App\Traits\FileManagerTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiderVehicleExport;

class RiderVehicleController extends Controller
{
    use FileManagerTrait;

    public function index(?Request $request, string $type = null)
    {
        $key = explode(' ', $request['search']);
        $criteria = array_merge($request->all(), ['vehicle_request_status' => APPROVED]);

        $vehicles = RiderVehicle::with(['brand', 'model', 'category', 'driver'])
            ->whereNot('vehicle_request_status', 'pending')
            ->when(isset($key ), function ($q) use ($key){
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                });
            })
            ->latest()
            ->paginate(config('default_pagination')??25);
        $categories = RiderVehicleCategory::with('vehicles')->get();
        return view('admin-views.rider-vehicle-management.vehicle.list', compact('vehicles', 'categories'));
    }

    public function create()
    {

        return view('admin-views.rider-vehicle-management.vehicle.create');
    }

    public function store(VehicleStoreUpdateRequest $request)
    {
        $request->validate([
            'vin_number' => 'unique:rider_vehicles,vin_number',
            'licence_plate_number' => 'unique:rider_vehicles,licence_plate_number',

        ]);

        $vehicleDocuments = [];
        if (!empty($request->file('documents'))) {
            foreach ($request->documents as $img) {
                $extension = $img->getClientOriginalExtension();
                $documents = Helpers::upload('vehicle/', $extension, $img);
                $vehicleDocuments[] = ['img' => $documents, 'storage' => Helpers::getDisk()];
            }
            $documents = json_encode($vehicleDocuments);
        } else {
            $documents = json_encode([]);
        }

        $vehicle = new RiderVehicle();
        $vehicle->name = $request->name[array_search('default', $request->lang)];
        $vehicle->brand_id = $request->brand_id;
        $vehicle->category_id = $request->category_id;
        $vehicle->model_id = $request->model_id;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->transmission = $request->transmission;
        $vehicle->ownership = $request->ownership;
        $vehicle->rider_id = $request->rider_id;
        $vehicle->vin_number = $request->vin_number;
        $vehicle->licence_plate_number = $request->licence_plate_number;
        $vehicle->licence_expire_date = $request->licence_expire_date;
        $vehicle->documents = $documents;
        $vehicle->is_active = 1;

        $vehicle->save();

        Helpers::add_or_update_translations(request: $request, key_data: 'name', name_field: 'name', model_name: get_class($vehicle), data_id: $vehicle->id, data_value: $vehicle->name,model_class:true);

        Toastr::success(translate('messages.vehicle_added_successfully'));
        return back();
    }

    public function show(string $id)
    {
        $vehicle = RiderVehicle::with(['brand', 'model', 'category', 'driver'])->findOrFail($id);
        return view('admin-views.rider-vehicle-management.vehicle.details', compact('vehicle'));
    }

    public function edit(string $id)
    {
        $vehicle= RiderVehicle::withoutGlobalScope('translate')->with(['brand', 'model', 'category', 'driver'])->findOrFail($id);
        $language = getWebConfig('language');
        return view('admin-views.rider-vehicle-management.vehicle.edit', compact('vehicle', 'language'));
    }

    public function update(VehicleStoreUpdateRequest $request, string $id)
    {
        $request->validate([
            'vin_number' => 'unique:rider_vehicles,vin_number,'.$id,
            'licence_plate_number' => 'unique:rider_vehicles,licence_plate_number,'.$id,
        ]);

        $vehicle = RiderVehicle::findOrFail($id);
        if (!$vehicle) {
            Toastr::success(translate('messages.vehicle_not_found_successfully'));
            return back();
        }

        $docNames = [];
        if(isset($vehicle->documents)) {
            if(is_array($vehicle->documents)) {
                $docNames = $vehicle->documents;
            } else {
                $docNames = json_decode($vehicle->documents, true);
            }
        }
        // $docNames = !empty($vehicle->documents) ? json_decode($vehicle->documents, true) : [];

        if ($request->filled('removed_documents')) {
            $removedDocs = json_decode($request->input('removed_documents'), true);

            foreach ($removedDocs as $removedDoc) {
                $docNames = array_filter($docNames, function ($image) use ($removedDoc) {
                    return $image['img'] !== $removedDoc;
                });

                $docPath = 'vehicle/' . $removedDoc;
                Storage::disk(Helpers::getDisk())->delete($docPath);
            }
        }

        if (!empty($request->file('documents'))) {
            foreach ($request->documents as $doc) {
                $extension = $doc->getClientOriginalExtension();
                $file= $this->updateAndUpload('vehicle/', $vehicle->images, $extension, $doc);
                $docNames[] = ['img' => $file, 'storage' => Helpers::getDisk()];
            }
        }

        $documents = json_encode(array_values($docNames));

        $vehicle->name = $request->name[array_search('default', $request->lang)];
        $vehicle->brand_id = $request->brand_id;
        $vehicle->category_id = $request->category_id;
        $vehicle->model_id = $request->model_id;
        $vehicle->fuel_type = $request->fuel_type;
        $vehicle->transmission = $request->transmission;
        $vehicle->ownership = $request->ownership;
        $vehicle->rider_id = $request->rider_id;
        $vehicle->vin_number = $request->vin_number;
        $vehicle->licence_plate_number = $request->licence_plate_number;
        $vehicle->licence_expire_date = $request->licence_expire_date;
        $vehicle->documents = $documents;

        $vehicle->save();

        Helpers::add_or_update_translations(request: $request, key_data: 'name', name_field: 'name', model_name: get_class($vehicle), data_id: $vehicle->id, data_value: $vehicle->name,model_class:true);

        Toastr::success(translate('messages.vehicle_updated_successfully'));
        return back();
    }

    public function destroy(string $id)
    {
        $vehicle = RiderVehicle::findOrFail($id);
        if($vehicle->image)
        {

            Helpers::check_and_delete('vehicle/vehicle/' , $vehicle['image']);

        }
        $vehicle->translations()->delete();
        $vehicle->delete();
        Toastr::success(translate('messages.vehicle_deleted_successfully'));
        return back();
    }

    public function status(Request $request)
    {
        $model = RiderVehicle::findOrFail($request->id);
        $model->is_active = $request->status;
        $model->save();
        Toastr::success(translate('messages.vehicle_status_updated'));
        return back();
    }

    public function export(Request $request)
    {
        $key = explode(' ', $request['search']);

        $vehicles = RiderVehicle::with(['brand', 'model', 'category', 'driver'])
            ->whereNot('vehicle_request_status', 'pending')
            ->when(isset($key), function ($q) use ($key){
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                });
            })
            ->latest()
            ->get();

        $data = [
            'vehicles' => $vehicles,
            'search' => $request->search ?? 'N/A',
        ];

        if ($request->file == 'excel') {
            return Excel::download(new RiderVehicleExport($data), 'Rider-vehicles.xlsx');
        } else if ($request->file == 'csv') {
            return Excel::download(new RiderVehicleExport($data), 'Rider-vehicles.csv');
        }
    }


    public function newVehicleRequestList(Request $request)
    {
        $key = explode(' ', $request['search']);

        $vehicles = RiderVehicle::with(['brand', 'model', 'category', 'driver'])
            ->when(isset($key ), function ($q) use ($key){
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                });
            })
            ->where('vehicle_request_status',$request->status)
            ->latest()
            ->paginate(config('default_pagination')??25);
        return view('admin-views.rider-vehicle-management.vehicle.request-list', compact('vehicles'));

    }

    public function requestedVehicleInfo($id)
    {
        $vehicle = $this->vehicleService->findOne(id: $id, relations: ['model', 'brand', 'category', 'driver']);
        return view('vehiclemanagement::admin.vehicle.request.details', compact('vehicle'));
    }


    public function editVehicleRequest($id)
    {
        $vehicle = $this->vehicleService->findOne(id: $id, relations: ['model', 'brand', 'category', 'driver']);
        return view('vehiclemanagement::admin.vehicle.request.edit', compact('vehicle'));
    }

    public function approvedVehicleRequest($id)
    {
        $vehicle = RiderVehicle::findOrFail($id);
        $vehicle->vehicle_request_status = 'approved';
        $vehicle->is_active = 1;
        $vehicle->save();
        $push = getNotification('driver_registration_vehicle_request_approved');
        if ($vehicle && $vehicle?->driver?->fcm_token) {
            sendDeviceNotification(
                fcm_token: $vehicle?->driver->fcm_token,
                title: translate($push['title']),
                description: translate($push['description']),
                status: 1,
                action: $push['action'],
                user_id: $vehicle?->driver_id
            );
        }

        Toastr::success('Vehicle request approved successfully');
        return redirect()->back();
    }

    public function deniedVehicleRequest(Request $request, $id)
    {
        // $request->validate([
        //     'deny_note' => 'required|max:151'
        // ]);
        $vehicle = RiderVehicle::findOrFail($id);
        $vehicle->vehicle_request_status = 'denied';
        $vehicle->deny_note = $request->deny_note;
        $vehicle->save();

        $push = getNotification('driver_registration_vehicle_request_denied');
        if ($vehicle && $vehicle?->driver->fcm_token) {
            sendDeviceNotification(
                fcm_token: $vehicle?->driver->fcm_token,
                title: translate($push['title']),
                description: translate($push['description']),
                status: 1,
                action: $push['action'],
                user_id: $vehicle?->driver_id
            );
        }

        Toastr::success('Vehicle request denied successfully');
        return redirect()->back();
    }


    public function exportVehicleRequest(Request $request)
    {
        $criteria = array_merge($request->all(), ['vehicle_request_status' => $request->input('vehicle_request_status', PENDING)]);
        $data = $this->vehicleService->export(criteria: $criteria, relations: ['category', 'model', 'brand', 'driver'], orderBy: ['created_at' => 'desc']);
        return exportData($data, $request['file'], 'vehiclemanagement::admin.vehicle.print');
    }


    public function newVehicleUpdateList(Request $request)
    {
        $criteria = array_merge($request->all(), ['draft' => true]);
        $vehicles = $this->vehicleService->index(criteria: $criteria, relations: ['model', 'brand', 'category', 'driver'], orderBy: ['updated_at' => 'desc'], limit: paginationLimit(), offset: $request['page'] ?? 1);
        return view('vehiclemanagement::admin.vehicle.update.list', compact('vehicles'));

    }

    public function updatedVehicleInfo($id)
    {
        $vehicle = $this->vehicleService->findOne(id: $id, relations: ['model', 'brand', 'category', 'driver']);
        return view('vehiclemanagement::admin.vehicle.update.details', compact('vehicle'));
    }


    public function editVehicleUpdate($id)
    {
        $vehicle = $this->vehicleService->findOne(id: $id, relations: ['model', 'brand', 'category', 'driver']);
        return view('vehiclemanagement::admin.vehicle.update.edit', compact('vehicle'));
    }

    public function approvedVehicleUpdate($id)
    {
        $model = $this->vehicleService->update(id: $id, data: ['draft' => NULL]);
        $push = getNotification('vehicle_update_approved');
        if ($model && $model?->driver->fcm_token) {
            sendDeviceNotification(
                fcm_token: $model?->driver->fcm_token,
                title: translate($push['title']),
                description: translate($push['description']),
                status: 1,
                action: $push['action'],
                user_id: $model?->driver_id
            );
        }
        Toastr::success('Vehicle update approved successfully');
        return redirect()->back();
    }

    public function deniedVehicleUpdate(Request $request, $id)
    {
        $vehicle = $this->vehicleService->findOne(id: $id);
        $model = $this->vehicleService->deniedVehicleUpdateByAdmin(id: $vehicle->id, data: ['draft' => $vehicle->draft]);
        $push = getNotification('vehicle_update_denied');
        if ($model && $model?->driver->fcm_token) {
            sendDeviceNotification(
                fcm_token: $model?->driver->fcm_token,
                title: translate($push['title']),
                description: translate($push['description']),
                status: 1,
                action: $push['action'],
                user_id: $model?->driver_id
            );
        }

        Toastr::success('Vehicle request denied successfully');
        return redirect()->back();
    }

    public function exportVehicleUpdate(Request $request)
    {
        $criteria = array_merge($request->all(), ['draft' => true]);
        $data = $this->vehicleService->exportUpdateVehicle(criteria: $criteria, relations: ['category', 'model', 'brand', 'driver'], orderBy: ['created_at' => 'desc']);
        return exportData($data, $request['file'], 'vehiclemanagement::admin.vehicle.print');
    }
}

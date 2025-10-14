<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RiderVehicleBrand;
use App\Models\RiderVehicleModel;
use Brian2694\Toastr\Facades\Toastr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiderVehicleModelExport;

class RiderVehicleModelController extends Controller
{

    public function index(?Request $request, string $type = null)
    {
        $key = explode(' ', $request['search']);
        $models=RiderVehicleModel::
            with('brand')->
            when(isset($key ), function ($q) use ($key){
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('description', 'like', "%{$value}%");
                    }
                });
            })
            ->when(isset($request['status']) && $request['status'] != 'all', function ($q) use ($request) {
                $q->where('is_active', ($request['status'] == 'active') ? 1 : 0);
            })
            ->latest()->paginate(config('default_pagination'));

        $language = getWebConfig('language');
        return view('admin-views.rider-vehicle-management.model.index', compact('models', 'language'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'short_desc' => 'required|max:255',
            'model_image' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'name' => ['required'],
            'brand_id' => ['required',Rule::exists(RiderVehicleBrand::class,'id')],
            'short_desc' => 'nullable',
            'seat_capacity' => 'nullable|numeric|max:99999999|gt:0',
            'maximum_weight' => 'nullable|numeric|max:99999999|gt:0',
            'hatch_bag_capacity' => 'nullable|numeric|max:99999999|gt:0',
            'engine' => 'nullable',
        ]);

        $model = new RiderVehicleModel();
        $model->name = $request['name'][array_search('default', $request['lang'])];
        $model->description = $request['short_desc'][array_search('default', $request['lang'])];
        $model->image = Helpers::upload('vehicle/model/', 'png', $request->file('model_image'));
        $model->brand_id = $request['brand_id'];
        $model->seat_capacity = $request['seat_capacity'] ?? 0;
        $model->maximum_weight = $request['maximum_weight'] ?? 0;
        $model->hatch_bag_capacity = $request['hatch_bag_capacity'] ?? 0;
        $model->engine = $request['engine'] ?? null;
        $model->is_active = 1;
        $model->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'short_desc',
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->description,
            model_class: true
        );

        Toastr::success(translate('messages.Vehicle_model_added_successfully'));
        return back();
    }

    public function edit($id)
    {
        $model= RiderVehicleModel::withoutGlobalScope('translate')->with('brand')->findOrFail($id);
        $language = getWebConfig('language');
        return view('admin-views.rider-vehicle-management.model.edit', compact('model', 'language'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'short_desc' => 'required|max:255',
            'model_image' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'name' => ['required'],
            'brand_id' => ['required',Rule::exists(RiderVehicleBrand::class,'id')],
            'short_desc' => 'nullable',
            'seat_capacity' => 'nullable|numeric|max:99999999|gt:0',
            'maximum_weight' => 'nullable|numeric|max:99999999|gt:0',
            'hatch_bag_capacity' => 'nullable|numeric|max:99999999|gt:0',
            'engine' => 'nullable',
        ]);

        $model = RiderVehicleModel::findOrFail($id);
        $model->name = $request['name'][array_search('default', $request['lang'])];
        $model->description = $request['short_desc'][array_search('default', $request['lang'])];
        if ($request->hasFile('model_image')) {
            $model->image = Helpers::update('vehicle/model/', $model->image, 'png', $request->file('model_image'));
        }
        $model->brand_id = $request['brand_id'];
        $model->seat_capacity = $request['seat_capacity'] ?? 0;
        $model->maximum_weight = $request['maximum_weight'] ?? 0;
        $model->hatch_bag_capacity = $request['hatch_bag_capacity'] ?? 0;
        $model->engine = $request['engine'] ?? null;
        $model->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'short_desc',
            model_name: get_class($model),
            data_id: $model->id,
            data_value: $model->description,
            model_class: true
        );

        Toastr::success(translate('messages.Vehicle_model_updated_successfully'));
        return back();
    }

    public function destroy($id)
    {
        $model = RiderVehicleModel::findOrFail($id);
        if($model->image)
        {

            Helpers::check_and_delete('vehicle/model/' , $model['image']);

        }
        $model->translations()->delete();
        $model->delete();
        Toastr::success(translate('messages.model_deleted_successfully'));
        return back();
    }

    public function getAllAjax(Request $request)
    {
        $key = explode(' ', $request['search']);
        $models = RiderVehicleModel::orderBy('name')
        ->when(isset($key), function($query) use($key) {
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('description', 'like', "%{$value}%");
                }
            });
        })
        ->get();
        $selectmodels = $models->map(function ($items, $key) {
            return [
                'text' => $items->name,
                'id' => $items->id
            ];
        });
        return response()->json($selectmodels);
    }

    public function status(Request $request)
    {
        $model = RiderVehicleModel::findOrFail($request->id);
        $model->is_active = $request->status;
        $model->save();
        Toastr::success(translate('messages.model_status_updated'));
        return back();
    }

    public function export(Request $request)
    {
        $key = explode(' ', $request['search']);
        $status = $request->get('status', 'all');

        $models = RiderVehicleModel::with('brand')
            ->when(isset($key), function($query) use($key) {
                $query->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('description', 'like', "%{$value}%");
                    }
                });
            })
            ->when($status != 'all', function($q) use($status) {
                $q->where('is_active', $status === 'active' ? 1 : 0);
            })
            ->latest()
            ->get();

        $data = [
            'models' => $models,
            'search' => $request->search ?? 'N/A',
            'status' => $status ?? 'all',
        ];

        if ($request->file == 'excel') {
            return Excel::download(new RiderVehicleModelExport($data), 'Rider-vehicle-models.xlsx');
        } else if ($request->file == 'csv') {
            return Excel::download(new RiderVehicleModelExport($data), 'Rider-vehicle-models.csv');
        }
    }

    public function ajax_models(Request $request, $brand_id)
    {
        $attributes = ['brand_id' => $brand_id, 'is_active' => 1];
        $models = RiderVehicleModel::orderBy('name')->where('brand_id', $brand_id)->where('is_active', 1)->get();
        return response()->json([
            'template' => view('admin-views.rider-vehicle-management.partials._model-selector', compact('models'))->render(),
        ]);
    }

}

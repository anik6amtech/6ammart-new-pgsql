<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RiderVehicleCategory;
use Brian2694\Toastr\Facades\Toastr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiderVehicleCategoryExport;

class RiderVehicleCategoryController extends Controller
{

    public function index(?Request $request, string $type = null)
    {
        $key = explode(' ', $request['search']);
        $categories=RiderVehicleCategory::
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
        return view('admin-views.rider-vehicle-management.category.index', compact('categories', 'language'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_desc' => 'required|max:255',
            'type' => 'required',
            'category_image' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'category_use_for' => 'required|array',
            'extra_charges' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array('delivery', $request->category_use_for ?? []);
                }),
                'nullable',
                'numeric',
                'between:0,999999999999.99'
            ],
            'starting_coverage_area' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array('delivery', $request->category_use_for ?? []);
                }),
                'nullable',
                'numeric',
                'between:0,999999999999.99'
            ],
            'maximum_coverage_area' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array('delivery', $request->category_use_for ?? []);
                }),
                'nullable',
                'numeric',
                'between:0.01,999999999999.99',
                'gt:starting_coverage_area'
            ],
        ]);

        $category = new RiderVehicleCategory();
        $category->name = $request['name'][array_search('default', $request['lang'])];
        $category->description = $request['short_desc'][array_search('default', $request['lang'])];
        $category->image = Helpers::upload('vehicle/category/', 'png', $request->file('category_image'));
        $category->is_active = 1;
        $category->type = $request['type'];
        $category->is_delivery = in_array('delivery', $request->category_use_for ?? []) ? 1 : 0;
        $category->is_ride     = in_array('ride', $request->category_use_for ?? []) ? 1 : 0;
        $category->extra_charges = $request['extra_charges'];
        $category->starting_coverage_area = $request['starting_coverage_area'];
        $category->maximum_coverage_area = $request['maximum_coverage_area'];
        $category->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'short_desc',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->description,
            model_class: true
        );

        Toastr::success(translate('messages.Vehicle_category_added_successfully'));
        return back();
    }

    public function edit($id)
    {
        $category= RiderVehicleCategory::withoutGlobalScope('translate')->findOrFail($id);
        $language = getWebConfig('language');
        return view('admin-views.rider-vehicle-management.category.edit', compact('category', 'language'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'short_desc' => 'required|max:255',
            'type' => 'required',
            'category_image' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'category_use_for' => 'required|array',
            'extra_charges' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array('delivery', $request->category_use_for ?? []);
                }),
                'nullable',
                'numeric',
                'between:0,999999999999.99'
            ],
            'starting_coverage_area' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array('delivery', $request->category_use_for ?? []);
                }),
                'nullable',
                'numeric',
                'between:0,999999999999.99'
            ],
            'maximum_coverage_area' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array('delivery', $request->category_use_for ?? []);
                }),
                'nullable',
                'numeric',
                'between:0.01,999999999999.99',
                'gt:starting_coverage_area'
            ],
        ]);

        $category = RiderVehicleCategory::findOrFail($id);
        $category->name = $request['name'][array_search('default', $request['lang'])];
        $category->description = $request['short_desc'][array_search('default', $request['lang'])];
        if ($request->hasFile('category_image')) {
            $category->image = Helpers::update('vehicle/category/', $category->image, 'png', $request->file('category_image'));
        }
        $category->type = $request['type'];
        $category->is_delivery = in_array('delivery', $request->category_use_for ?? []) ? 1 : 0;
        $category->is_ride     = in_array('ride', $request->category_use_for ?? []) ? 1 : 0;
        $category->extra_charges = $request['extra_charges'];
        $category->starting_coverage_area = $request['starting_coverage_area'];
        $category->maximum_coverage_area = $request['maximum_coverage_area'];
        $category->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'short_desc',
            model_name: get_class($category),
            data_id: $category->id,
            data_value: $category->description,
            model_class: true
        );

        Toastr::success(translate('messages.Vehicle_category_updated_successfully'));
        return back();
    }

    public function destroy($id)
    {
        $category = RiderVehicleCategory::findOrFail($id);
        if($category->image)
        {

            Helpers::check_and_delete('vehicle/category/' , $category['image']);

        }
        $category->translations()->delete();
        $category->delete();
        Toastr::success(translate('messages.category_deleted_successfully'));
        return back();
    }

    public function getAllAjax(Request $request)
    {
        $key = explode(' ', $request['search']);
        $type = explode(',', $request['type']);

        $categories = RiderVehicleCategory::orderBy('name')
        ->when(isset($key), function($query) use($key) {
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('description', 'like', "%{$value}%");
                }
            });
        })
        ->when(in_array('delivery', $type), function($query) {
            $query->where('is_delivery', 1);
        })
        ->when(in_array('ride', $type), function($query) {
            $query->where('is_ride', 1);
        })
        ->when(isset($request->status), function($query) use($request) {
            if ($request->status == 'active') {
                $query->where('is_active', 1);
            } elseif ($request->status == 'inactive') {
                $query->where('is_active', 0);
            }
        })
        ->get();
        $selectcategories = $categories->map(function ($items, $key) {
            return [
                'text' => $items->name,
                'id' => $items->id
            ];
        });
        return response()->json($selectcategories);
    }

    public function status(Request $request)
    {
        $category = RiderVehicleCategory::findOrFail($request->id);
        $category->is_active = $request->status;
        $category->save();
        Toastr::success(translate('messages.category_status_updated'));
        return back();
    }

    public function export(Request $request)
    {
        $key = explode(' ', $request['search']);
        $status = $request->get('status', 'all');

        $categories = RiderVehicleCategory::when(isset($key), function($query) use($key) {
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
            'categories' => $categories,
            'search' => $request->search ?? 'N/A',
            'status' => $status ?? 'all',
        ];

        if ($request->file == 'excel') {
            return Excel::download(new RiderVehicleCategoryExport($data), 'Rider-vehicle-categories.xlsx');
        } else if ($request->file == 'csv') {
            return Excel::download(new RiderVehicleCategoryExport($data), 'Rider-vehicle-categories.csv');
        }
    }

}

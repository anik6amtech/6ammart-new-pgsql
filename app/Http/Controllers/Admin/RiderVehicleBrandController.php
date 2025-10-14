<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RiderVehicleBrand;
use Brian2694\Toastr\Facades\Toastr;
use Barryvdh\DomPDF\Facade\Pdf;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiderVehicleBrandExport;

class RiderVehicleBrandController extends Controller
{

    public function index(?Request $request, string $type = null)
    {
        $status = $request->get('status', 'all');
        $brands = RiderVehicleBrand::when($request->filled('search'), function ($q) use ($request) {
            $key = explode(' ', $request->input('search'));
            $q->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('description', 'like', "%{$value}%");
                }
            });
        })
            ->when(in_array($status, ['active','inactive']), function($q) use($status) {
                $q->where('is_active', $status === 'active' ? 1 : 0);
            })
            ->latest()
            ->paginate(config('default_pagination'));

        $language = getWebConfig('language');
        return view('admin-views.rider-vehicle-management.brand.index', compact('brands', 'language', 'status'));
    }

    /**
     * Export rider vehicle brands to Excel
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        $brands = RiderVehicleBrand::when($request->filled('search'), function ($q) use ($request) {
                $key = explode(' ', $request->input('search'));
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('description', 'like', "%{$value}%");
                    }
                });
            })
            ->when($request->has('status') && in_array($request->status, ['active', 'inactive']), function($q) use($request) {
                $q->where('is_active', $request->status === 'active' ? 1 : 0);
            })
            ->latest()
            ->get();

        $data = [
            'brands' => $brands,
            'search' => $request->search ?? 'N/A',
            'status' => $request->status ?? 'all',
        ];

        if ($request->file == 'excel') {
            return Excel::download(new RiderVehicleBrandExport($data), 'Rider-vehicle-brands.xlsx');
        } else if ($request->file == 'csv') {
            return Excel::download(new RiderVehicleBrandExport($data), 'Rider-vehicle-brands.csv');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|max:255',
            'short_desc' => 'required|max:255',
            'brand_logo' => 'required|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        $brand = new RiderVehicleBrand();
        $brand->name = $request['brand_name'][array_search('default', $request['lang'])];
        $brand->description = $request['short_desc'][array_search('default', $request['lang'])];
        $brand->image = Helpers::upload('vehicle/brand/', 'png', $request->file('brand_logo'));
        $brand->is_active = 1;
        $brand->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'brand_name',
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'short_desc',
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->description,
            model_class: true
        );

        Toastr::success(translate('messages.Vehicle_brand_added_successfully'));
        return back();
    }

    public function edit($id)
    {
        $brand= RiderVehicleBrand::withoutGlobalScope('translate')->findOrFail($id);
        $language = getWebConfig('language');
        return view('admin-views.rider-vehicle-management.brand.edit', compact('brand', 'language'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|max:255',
            'short_desc' => 'required|max:255',
            'brand_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
        ]);

        $brand = RiderVehicleBrand::findOrFail($id);
        $brand->name = $request['brand_name'][array_search('default', $request['lang'])];
        $brand->description = $request['short_desc'][array_search('default', $request['lang'])];
        if ($request->hasFile('brand_logo')) {
            $brand->image = Helpers::update('vehicle/brand/', $brand->image, 'png', $request->file('brand_logo'));
        }
        $brand->save();

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'brand_name',
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->name,
            model_class: true
        );
        Helpers::add_or_update_translations(
            request: $request,
            key_data:'description',
            name_field:'short_desc',
            model_name: get_class($brand),
            data_id: $brand->id,
            data_value: $brand->description,
            model_class: true
        );

        Toastr::success(translate('messages.Vehicle_brand_updated_successfully'));
        return back();
    }

    public function destroy($id)
    {
        $brand = RiderVehicleBrand::findOrFail($id);
        if($brand->image)
        {

            Helpers::check_and_delete('vehicle/brand/' , $brand['image']);

        }
        $brand->translations()->delete();
        $brand->delete();
        Toastr::success(translate('messages.brand_deleted_successfully'));
        return back();
    }

    public function getAllAjax(Request $request)
    {
        if(isset($request['search'])) {
            $key = explode(' ', $request['search']);
        } else {
            $key = explode(' ', $request['q']);
        }

        $brands = RiderVehicleBrand::orderBy('name')
        ->when(isset($key), function($query) use($key) {
            $query->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('description', 'like', "%{$value}%");
                }
            });
        })
        ->when(isset($request->status), function($query) use($request) {
            if ($request->status == 'active') {
                $query->where('is_active', 1);
            } elseif ($request->status == 'inactive') {
                $query->where('is_active', 0);
            }
        })
        ->get();
        $selectBrands = $brands->map(function ($items, $key) {
            return [
                'text' => $items->name,
                'id' => $items->id
            ];
        });
        return response()->json($selectBrands);
    }

    public function status(Request $request)
    {
        $brand = RiderVehicleBrand::findOrFail($request->id);
        $brand->is_active = $request->status;
        $brand->save();
        Toastr::success(translate('messages.brand_status_updated'));
        return back();
    }

//    public function export(Request $request)
//    {
//        $key = explode(' ', $request['search']);
//        $status = $request->get('status', 'all');
//        $brands = RiderVehicleBrand::orderBy('name')
//        ->when(isset($key), function($query) use($key) {
//            $query->where(function ($q) use ($key) {
//                foreach ($key as $value) {
//                    $q->orWhere('name', 'like', "%{$value}%")
//                    ->orWhere('description', 'like', "%{$value}%");
//                }
//            });
//        })
//        ->when(in_array($status, ['active','inactive']), function($q) use($status) {
//            $q->where('is_active', $status === 'active' ? 1 : 0);
//        })
//        ->get();
//
//        $file = $request['file'];
//        $viewPath = 'admin-views.rider-vehicle-management.brand.print';
//        $data = $brands;
//
//        return match ($file) {
//            'csv' => (new FastExcel($data))->download( 'Brand.csv'),
//            'excel' => (new FastExcel($data))->download('Brand.xlsx'),
//            'pdf' => Pdf::loadView($viewPath, ['data' => $data])->download('Brand.pdf'),
//            default => view($viewPath, ['data' => $data]),
//        };
//    }

}

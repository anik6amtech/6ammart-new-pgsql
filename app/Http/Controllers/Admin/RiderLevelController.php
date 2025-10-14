<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverLevelStoreOrUpdateRequest;
use App\Models\UserLevel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RiderLevelExport;

class RiderLevelController extends Controller
{
    public function index(?Request $request, string $type = null)
    {
        $query = UserLevel::query();
        // Load nested relations
        // $query->with([
        //     'users.driverTrips',
        //     'users.driverTripsStatus',
        // ]);
        $query->when(isset($request['status']) && $request['status'] != 'all', function ($q) use ($request) {
            $q->where('is_active', ($request['status'] == 'active') ? 1 : 0);
        });
        $query->when($request->has('search') && $request->search != '', function ($q) use ($request) {
            $search = $request->search;
            $q->where(function ($qq) use ($search) {
                $qq->where('name', 'like', "%{$search}%");
            });
        });

        // Count related users
        $query->withCount('users');

        // Apply ordering
        $query->orderBy('sequence', 'asc');

        $levels = $query->paginate(config('default_pagination'));

        return view('admin-views.rider-label.list', compact('levels'));
    }

    public function create()
    {
        $levels = UserLevel::where('user_type', DRIVER)->get();
        $levelArray = $levels->pluck('sequence')->toArray();
        $sequence_array = range(1, 12);
        $sequences = array_values(array_diff($sequence_array, $levelArray));
        $language = getWebConfig('language');
        return view('admin-views.rider-label.create', compact('sequences','language'));
    }

    public function store(DriverLevelStoreOrUpdateRequest $request)
    {
        $levels = UserLevel::where('user_type', DRIVER)->get();
        if (($levels->isEmpty()) && $request['sequence'] != 1) {
            Toastr::error(LEVEL_CREATE_403['message']);
            return back();
        }

        $lavel = new UserLevel();

        $lavel->sequence = $request->sequence;
        $lavel->name = $request['name'][array_search('default', $request['lang'])];
        $lavel->reward_type = $request->reward_type;
        $lavel->targeted_ride = $request->targeted_ride ?? 0;
        $lavel->targeted_ride_point = $request->targeted_ride_point ?? 0;
        $lavel->targeted_amount = $request->targeted_amount ?? 0;
        $lavel->targeted_amount_point = $request->targeted_amount_point ?? 0;
        $lavel->targeted_cancel = $request->targeted_cancel ?? 0;
        $lavel->targeted_cancel_point = $request->targeted_cancel_point ?? 0;
        $lavel->targeted_review = $request->targeted_review ?? 0;
        $lavel->targeted_review_point = $request->targeted_review_point ?? 0;
        $lavel->image = Helpers::upload('driver/level/', 'png', $request->image);
        $lavel->user_type = DRIVER;
        $lavel->save();

        if ($lavel->reward_type !== 'no_rewards') {
            $lavel->reward_amount = $request->reward_amount;
            $lavel->save();
        }

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($lavel),
            data_id: $lavel->id,
            data_value: $lavel->name,
            model_class: true
        );

        Toastr::success(LEVEL_CREATE_200['message']);
        return back();

    }

    public function edit($id)
    {
        $level= UserLevel::withoutGlobalScope('translate')->findOrFail($id);
        $language = getWebConfig('language');
        return view('admin-views.rider-label.edit', compact('level', 'language'));
    }

    public function update(DriverLevelStoreOrUpdateRequest $request, $id)
    {
        $lavel = UserLevel::findOrFail($id);
        $lavel->name = $request['name'][array_search('default', $request['lang'])];
        $lavel->reward_type = $request->reward_type;
        $lavel->targeted_ride = $request->targeted_ride ?? 0;
        $lavel->targeted_ride_point = $request->targeted_ride_point ?? 0;
        $lavel->targeted_amount = $request->targeted_amount ?? 0;
        $lavel->targeted_amount_point = $request->targeted_amount_point ?? 0;
        $lavel->targeted_cancel = $request->targeted_cancel ?? 0;
        $lavel->targeted_cancel_point = $request->targeted_cancel_point ?? 0;
        $lavel->targeted_review = $request->targeted_review ?? 0;
        $lavel->targeted_review_point = $request->targeted_review_point ?? 0;
        if ($request->hasFile('image')) {
            $lavel->image = Helpers::upload('driver/level/', 'png', $request->image);
        }
        $lavel->save();

        if ($lavel->reward_type !== 'no_rewards') {
            $lavel->reward_amount = $request->reward_amount;
            $lavel->save();
        }

        Helpers::add_or_update_translations(
            request: $request,
            key_data:'name',
            name_field:'name',
            model_name: get_class($lavel),
            data_id: $lavel->id,
            data_value: $lavel->name,
            model_class: true
        );

        Toastr::success(LEVEL_UPDATE_200['message']);
        return back();

    }


    public function status(Request $request)
    {
        $level = UserLevel::findOrFail($request->id);
        $level->is_active = $request->status;
        $level->save();
        Toastr::success(translate('messages.level_status_updated'));
        return back();
    }

    public function destroy($id)
    {
        $level = UserLevel::withCount('users')->findOrFail($id);
        if ($level?->users_count > 0) {
            Toastr::error(LEVEL_DELETE_403['message']);
            return back();
        }
        if($level->image)
        {

            Helpers::check_and_delete('driver/level/' , $level['image']);

        }
        $level->translations()->delete();
        $level->delete();
        Toastr::success(LEVEL_DELETE_200['message']);
        return back();
    }

    public function export(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = UserLevel::query();
        $query->when($status != 'all', function ($q) use ($status) {
            $q->where('is_active', ($status == 'active') ? 1 : 0);
        });
        $query->when($request->has('search') && $request->search != '', function ($q) use ($request) {
            $search = $request->search;
            $q->where(function ($qq) use ($search) {
                $qq->where('name', 'like', "%{$search}%");
            });
        });

        // Count related users
        $query->withCount('users');

        // Apply ordering
        $query->orderBy('sequence', 'asc');

        $levels = $query->get();

        $data = [
            'levels' => $levels,
            'search' => $request->search ?? 'N/A',
            'status' => $status ?? 'all',
        ];

        if ($request->file == 'excel') {
            return Excel::download(new RiderLevelExport($data), 'Rider-levels.xlsx');
        } else if ($request->file == 'csv') {
            return Excel::download(new RiderLevelExport($data), 'Rider-levels.csv');
        }
    }
}

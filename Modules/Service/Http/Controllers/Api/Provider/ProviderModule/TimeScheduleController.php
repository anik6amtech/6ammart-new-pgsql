<?php

namespace Modules\Service\Http\Controllers\Api\Provider\ProviderModule;

use App\CentralLogics\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Service\Entities\ProviderManagement\ProviderSchedule;

class TimeScheduleController extends Controller
{

    public function add_schedule(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'opening_time'=>'required|date_format:H:i:s',
            'closing_time'=>'required|date_format:H:i:s|after:opening_time',
        ],[
            'closing_time.after'=>translate('messages.End time must be after the start time')
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)],400);
        }
        $store = $request->user('provider');
        $temp = ProviderSchedule::where('day', $request->day)->where('service_provider_id',$store->id)
            ->where(function($q)use($request){
                return $q->where(function($query)use($request){
                    return $query->where('opening_time', '<=' , $request->opening_time)->where('closing_time', '>=', $request->opening_time);
                })->orWhere(function($query)use($request){
                    return $query->where('opening_time', '<=' , $request->closing_time)->where('closing_time', '>=', $request->closing_time);
                });
            })
            ->first();

        if(isset($temp))
        {
            return response()->json(['errors' => [
                ['code'=>'time', 'message'=>translate('messages.schedule_overlapping_warning')]
            ]], 400);
        }

        $store_schedule = ProviderSchedule::insertGetId(['service_provider_id'=>$store->id,'day'=>$request->day,'opening_time'=>$request->opening_time,'closing_time'=>$request->closing_time]);
        return response()->json(['message'=>translate('messages.Schedule added successfully'), 'id'=>$store_schedule], 200);
    }

    public function remove_schedule(Request $request, $store_schedule)
    {
        $store = $request->user('provider');
        $schedule = ProviderSchedule::where('service_provider_id', $store->id)->find($store_schedule);
        if(!$schedule)
        {
            return response()->json([
                'error'=>[
                    ['code'=>'not-fond', 'message'=>translate('messages.Schedule not found')]
                ]
            ],404);
        }
        $schedule->delete();
        return response()->json(['message'=>translate('messages.Schedule removed successfully')], 200);
    }
}

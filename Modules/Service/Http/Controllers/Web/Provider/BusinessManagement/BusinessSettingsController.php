<?php

namespace Modules\Service\Http\Controllers\Web\Provider\BusinessManagement;

use App\CentralLogics\Helpers;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Service\Entities\ProviderManagement\Provider;
use Modules\Service\Entities\ProviderManagement\ProviderSetting;

class BusinessSettingsController extends Controller
{
    public function providerSetup()
    {
        $providerId = Helpers::get_provider_id();
        $provider = Provider::withoutGlobalScope('translate')->findOrFail($providerId);
        $settings = ProviderSetting::where('provider_id', $providerId)
            ->where('type', 'provider_config')
            ->pluck('value', 'key')
            ->toArray();

        return view('service::provider.business-management.provider-config', compact('provider','settings'));
    }

    public function updateSetup(Request $request)
    {
        if($request->input('instant_booking') == 0 && $request->input('schedule_booking') == 0) {
            Toastr::error(translate('messages.You_must_enable_instant_or_schedule_booking'));
            return back();
        }

        DB::beginTransaction();
        try {
            $providerId = Helpers::get_provider_id();
            $provider = Provider::findOrFail($providerId);
            $provider->service_availability = $request->service_availability ? 1 : 0;
            $provider->minimum_service_time = $request->minimum_service_time ?? 0;
            $provider->maximum_service_time = $request->maximum_service_time ?? 0;
            $provider->service_time_type = $request->service_time_type ?? 'minutes';
            $provider->save();

            $keys = [
                // 'provider_vat_percent' => 'int',
                'instant_booking' => 'bool',
                'repeat_booking' => 'bool',
                'schedule_booking' => 'bool',
                'time_restriction_on_schedule_booking' => 'bool',
                'time_restriction_on_schedule_booking_value' => 'int',
                'time_restriction_on_schedule_booking_type' => 'string',
                'service_at_customer_location' => 'bool',
                'service_at_provider_location' => 'bool',
                'serviceman_can_cancel_booking' => 'bool',
                'serviceman_can_edit_booking' => 'bool'
            ];

            foreach ($keys as $key => $type) {
                $value = $request->$key;
                if ($type === 'int') {
                    $value = (int)$value;
                } elseif ($type === 'bool') {
                    $value = 0;
                    if($request->has($key) && ($request->$key == '1')) {
                        $value = 1;
                    }
                } elseif ($type === 'string') {
                    $value = (string)$value;
                } else {
                    continue;
                }

                ProviderSetting::updateOrCreate(['key' => $key, 'provider_id' => $providerId, 'type' => 'provider_config'], [
                    'value' => $value,
                    'is_active' => 1,
                ]);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(translate(DEFAULT_FAIL_200['message']));
            return back();
        }
        DB::commit();

        Toastr::success(translate(DEFAULT_UPDATE_200['message']));
        return back();
    }
}

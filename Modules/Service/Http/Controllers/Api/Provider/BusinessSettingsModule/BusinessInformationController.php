<?php

namespace Modules\Service\Http\Controllers\Api\Provider\BusinessSettingsModule;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Service\Entities\ProviderManagement\ProviderSetting;
use Illuminate\Support\Facades\DB;

class BusinessInformationController extends Controller
{
    private ProviderSetting $providerSetting;

    public function __construct(ProviderSetting $providerSetting)
    {
        $this->providerSetting = $providerSetting;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function businessSettingsGet(Request $request): JsonResponse
    {
        $data = $this->providerSetting
            ->where('provider_id', $request->user('provider')->id)
            ->where('type', 'provider_config')
            ->pluck('value', 'key')
            ->toArray();

        $provider = $request->user('provider');
        $data['service_availability'] = $provider->service_availability;
        $data['minimum_service_time'] = $provider->minimum_service_time;
        $data['maximum_service_time'] = $provider->maximum_service_time;
        $data['service_time_type'] = $provider->service_time_type;

        return response()->json(response_formatter(DEFAULT_200, $data), 200);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function businessSettingsSet(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'service_availability' => 'required|boolean',
            // 'minimum_service_time' => 'required|integer',
            // 'maximum_service_time' => 'required|integer',
            // 'service_time_type' => 'required|string',
            'data' => 'required',
            'data.*.key' => 'required|string',
            'data.*.value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(response_formatter(DEFAULT_400, null, error_processor($validator)), 400);
        }

        DB::beginTransaction();
        try {
            $provider = $request->user('provider');
            $provider->service_availability = $request->service_availability ? 1 : 0;
            $provider->minimum_service_time = $request->minimum_service_time ?? 0;
            $provider->maximum_service_time = $request->maximum_service_time ?? 0;
            $provider->service_time_type = $request->service_time_type ?? 'minutes';
            $provider->save();

            $keys = [
                'instant_booking' => 'bool',
                'repeat_booking' => 'bool',
                'schedule_booking' => 'bool',
                'time_restriction_on_schedule_booking' => 'bool',
                'time_restriction_on_schedule_booking_value' => 'int',
                'time_restriction_on_schedule_booking_type' => 'string',
                'service_at_customer_location' => 'bool',
                'service_at_provider_location' => 'bool',
                'serviceman_can_cancel_booking' => 'bool',
                'serviceman_can_edit_booking' => 'bool',
            ];

            $data = is_array($request->data) ? $request->data : json_decode($request->data, true);

            $customerLocationItem = collect($data)->firstWhere('key', 'service_at_customer_location');
            $providerLocationItem = collect($data)->firstWhere('key', 'service_at_provider_location');
            $instant_booking = collect($data)->firstWhere('key', 'instant_booking');
            $schedule_booking = collect($data)->firstWhere('key', 'schedule_booking');
            $customerLocation = $customerLocationItem['value'] ?? '0';
            $providerLocation = $providerLocationItem['value'] ?? '0';

            // Prevent both instant_booking and schedule_booking from being inactive
            if (($instant_booking['value'] ?? 0) == 0 && ($schedule_booking['value'] ?? 0) == 0) {
                $error = [
                    [
                        'error_code' => 'booking',
                        'message' => translate('messages.You_must_enable_instant_or_schedule_booking'),
                    ],
                ];
                return response()->json(response_formatter(DEFAULT_400, null, $error), 400);
            }

            // Prevent both customer_location and provider_location from being inactive
            if ($customerLocation == '0' && $providerLocation == '0') {
                $error = [
                    [
                        'error_code' => 'data',
                        'message' => translate('At least one service location must be active'),
                    ],
                ];
                return response()->json(response_formatter(DEFAULT_400, null, $error), 400);
            }
            foreach ($keys as $key => $type) {
                $item = collect($data)->firstWhere('key', $key);
                $value = $item['value'] ?? null;
                if ($type === 'int') {
                    $value = (int) $value;
                } elseif ($type === 'bool') {
                    $value = 0;
                    if (isset($item['value']) && ($item['value'] == '1' || $item['value'] === 1)) {
                        $value = 1;
                    }
                } elseif ($type === 'string') {
                    $value = (string) $value;
                } else {
                    continue;
                }

                $this->providerSetting->updateOrCreate(
                    [
                        'key' => $key,
                        'provider_id' => $provider->id,
                        'type' => 'provider_config',
                    ],
                    [
                        'value' => $value,
                        'is_active' => 1,
                    ],
                );
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(response_formatter(DEFAULT_FAIL_200), 500);
        }
        DB::commit();

        return response()->json(response_formatter(DEFAULT_UPDATE_200), 200);
    }
}

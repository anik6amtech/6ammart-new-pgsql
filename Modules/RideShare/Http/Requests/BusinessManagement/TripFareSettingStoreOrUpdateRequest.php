<?php

namespace Modules\RideShare\Http\Requests\BusinessManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TripFareSettingStoreOrUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'min_idle_fee_time' => [Rule::requiredIf(function () {
                return $this->input('type') === TRIP_FARE_SETTINGS;
            }), 'gt:0'],
            'min_delay_fee_time' => [Rule::requiredIf(function () {
                return $this->input('type') === TRIP_FARE_SETTINGS;
            }), 'gt:0'],
            'customer_route_preference' => [Rule::requiredIf(function () {
                return $this->input('type') === TRIP_SETTINGS;
            }), 'boolean'],
            'ride_request_active_time' => [Rule::requiredIf(function () {
                return $this->input('type') === TRIP_SETTINGS;
            }), 'gt:0', 'lte:30'],
            'trip_push_notification' => 'sometimes',
            'bidding_push_notification' => 'sometimes',
            "ride_otp_confirmation" => "nullable",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('admin')->check();
    }
}

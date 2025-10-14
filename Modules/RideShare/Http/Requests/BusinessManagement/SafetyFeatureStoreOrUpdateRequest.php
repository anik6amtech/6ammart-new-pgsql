<?php

namespace Modules\RideShare\Http\Requests\BusinessManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SafetyFeatureStoreOrUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'ride_safety_delay_time' => 'required|gt:0',
            'ride_safety_delay_time_format' => 'required',
            'safety_feature_after_ride_complete_status' => 'nullable',
            'safety_feature_after_ride_complete_time' => Rule::requiredIf(function () {
                return array_key_exists('safety_feature_after_ride_complete_status', $this->all());
            }),'gt:0',
            'safety_feature_after_ride_complete_time_format' => Rule::requiredIf(function () {
                return array_key_exists('safety_feature_after_ride_complete_status', $this->all());
            }),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }
}

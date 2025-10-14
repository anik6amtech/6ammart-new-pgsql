<?php

namespace Modules\RideShare\Http\Requests\BusinessManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BusinessSettingStoreOrUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "ride_commission" => "nullable|numeric|gt:0",
            "ride_vat" => "nullable|numeric|gte:0",
            "search_radius" => "nullable|numeric|gt:0",
            "rider_completion_radius" => "nullable|numeric|gt:0",
            'bid_on_fare' => 'sometimes',
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

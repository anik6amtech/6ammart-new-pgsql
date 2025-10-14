<?php

namespace Modules\RideShare\Http\Requests\VehicleManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VehicleBrandStoreUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id;
        return [
            'brand_name' => 'required',
            'short_desc' => 'required|max:900',
            'brand_logo' => [
                Rule::requiredIf(empty($id)),
                'image',
                'mimes:png,jpg,jpeg',
                'max:5000']
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

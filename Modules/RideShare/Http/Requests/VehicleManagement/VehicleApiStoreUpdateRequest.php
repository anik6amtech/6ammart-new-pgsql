<?php

namespace Modules\RideShare\Http\Requests\VehicleManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class VehicleApiStoreUpdateRequest extends FormRequest
{
    public function rules()
    {
        $id = $this->id;

        return [
            'name' => 'required',
            'brand_id' => 'required',
            'model_id' => 'required',
            'category_id' => 'required',
            'rider_id' => Rule::requiredIf(empty($id)),
            'ownership' => Rule::requiredIf(empty($id)),
            'licence_plate_number' => 'required',
            'licence_expire_date' => 'required|date',
            'vin_number' => 'sometimes',
            'transmission' => 'sometimes',
            // 'parcel_weight_capacity' => 'sometimes',
            'fuel_type' => Rule::requiredIf(empty($id)),
            'other_documents' => Rule::requiredIf(empty($id)),
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $data = json_decode($this->input('translations'), true);

            if (!is_array($data) || count($data) < 1) {
                $validator->errors()->add('translations', translate('messages.Name in english is required'));
            }
        });
    }
}

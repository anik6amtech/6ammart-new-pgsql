<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehicleStoreUpdateRequest extends FormRequest
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
            'name' => 'required|array',
            'brand_id' => 'required',
            'model_id' => 'required',
            'category_id' => 'required',
            'licence_plate_number' => 'required',
            'licence_expire_date' => 'required|date',
            'vin_number' => 'nullable',
            'transmission' => 'nullable',
            'parcel_weight_capacity' => 'nullable',
            'fuel_type' => 'required',
            'ownership' => 'required|in:admin,rider',
            'rider_id' => 'required|unique:rider_vehicles,rider_id,' . $id,
            'documents' => 'array',
            'documents.*' => [
                Rule::requiredIf(empty($id)),
                'mimes:xls,xlsx,pdf,png,jpeg,cvc,csv,jpg,webp',
                'max:10000'],
            'type' => 'nullable'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}

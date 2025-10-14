<?php

namespace Modules\RideShare\Http\Requests\VehicleManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Modules\RideShare\Entities\VehicleManagement\VehicleBrand;

class VehicleModelStoreUpdateRequest extends FormRequest
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
            'name' => ['required'],
            'brand_id' => ['required',Rule::exists(VehicleBrand::class,'id')],
            'short_desc' => 'nullable',
            'seat_capacity' => 'nullable|numeric|max:99999999|gt:0',
            'maximum_weight' => 'nullable|numeric|max:99999999|gt:0',
            'hatch_bag_capacity' => 'nullable|numeric|max:99999999|gt:0',
            'engine' => 'nullable',
            'model_image' => [
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

<?php

namespace Modules\RideShare\Http\Requests\PromotionManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BannerSetupStoreUpdateRequest extends FormRequest
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
            'title' => 'required',
            'title.0' => 'required|string',
            'time_period' => 'required',
            'redirect_link' => 'required|max:255',
            'start_date' => 'exclude_if:time_period,all_time|required|after_or_equal:today',
            'end_date' => 'exclude_if:time_period,all_time|required|after_or_equal:start_date',
            'banner_image' => [
                Rule::requiredIf(empty($id)),
                'image',
                'mimes:png,jpg,jpeg,webp',
                'max:5000']
        ];
    }

    public function messages()
    {
        return [
            'title.0.required' => 'Title is required',
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

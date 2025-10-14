<?php

namespace Modules\RideShare\Http\Requests\BusinessManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CancellationReasonStoreOrUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $id = $this->id;
        return [
            'title' => 'required|array|max:255|unique:ride_cancellation_reasons,title,' . $id,
            'cancellation_type' => 'required',
            'user_type' => 'required',
            'title.0' => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    public function messages()
    {
        return [
            'title.0.required'=>translate('default_title_is_required'),
        ];
    }
}

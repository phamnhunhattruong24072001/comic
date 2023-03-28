<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:6|max:50',
            'username' => 'required|min:6|max:20|unique:users,name,' . $this->id . ',id,deleted_at,NULL',
            'email' => 'required|email|unique:users,email,' . $this->id . ',id,deleted_at,NULL',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name' => [
                'required' => __('validation.custom.required'),
                'min' => __('validation.custom.min', ['count' => 6]),
                'max' => __('validation.custom.max', ['count' => 50]),
            ],
            'username' => [
                'required' => __('validation.custom.required'),
                'min' => __('validation.custom.min', ['count' => 6]),
                'max' => __('validation.custom.max', ['count' => 20]),
                'unique' => __('validation.custom.unique'),
            ],
            'email' => [
                'required' => __('validation.custom.required'),
                'email' => __('validation.custom.email'),
                'unique' => __('validation.custom.unique'),
            ],
            'avatar' => [
                'image' => __('validation.custom.images.image'),
                'mimes' => __('validation.custom.images.mimes'),
                'max' => __('validation.custom.images.max', ['count' => 2048]),
            ],
        ];
    }
}

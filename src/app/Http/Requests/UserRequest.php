<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:6',
                'max:50',
                'unique:users,name,' . $this->id . ',id,deleted_at,NULL'
            ],
            'username' => [
                'required',
                'min:6',
                'max:20',
                'unique:users,username,' . $this->id . ',id,deleted_at,NULL'
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->id . ',id,deleted_at,NULL'
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif|max:2048'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.custom.required'),
            'name.min' => __('validation.custom.min', ['count' => 6]),
            'name.max' => __('validation.custom.max', ['count' => 50]),
            'name.unique' => __('validation.custom.unique'),
            'username.required' => __('validation.custom.required'),
            'username.min' => __('validation.custom.min', ['count' => 6]),
            'username.max' => __('validation.custom.max', ['count' => 20]),
            'username.unique' => __('validation.custom.unique'),
            'email.required' => __('validation.custom.required'),
            'email.email' => __('validation.custom.email'),
            'email.unique' => __('validation.custom.unique'),
            'avatar.image' => __('validation.custom.images.image'),
            'avatar.mimes' => __('validation.custom.images.mimes'),
            'avatar.max' => __('validation.custom.images.max', ['count' => 2048]),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:4',
                'max:50',
                'unique:countries,name,' . $this->id . ',id,deleted_at,NULL'
            ],
            'another_name' => [
                'nullable',
                'min:4',
                'max:20',
                'unique:countries,another_name,' . $this->id . ',id,deleted_at,NULL'
            ],
            'slug' => [
                'required',
                'unique:countries,slug,' . $this->id . ',id,deleted_at,NULL'
            ],
            'avatar' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.custom.required'),
            'name.min' => __('validation.custom.min', ['count' => 4]),
            'name.max' => __('validation.custom.max', ['count' => 50]),
            'name.unique' => __('validation.custom.unique'),
            'another_name.required' => __('validation.custom.required'),
            'another_name.min' => __('validation.custom.min', ['count' => 4]),
            'another_name.max' => __('validation.custom.max', ['count' => 20]),
            'another_name.unique' => __('validation.custom.unique'),
            'slug.required' => __('validation.custom.required'),
            'slug.unique' => __('validation.custom.unique'),
            'avatar.image' => __('validation.custom.images.image'),
            'avatar.mimes' => __('validation.custom.images.mimes'),
            'avatar.max' => __('validation.custom.images.max', ['count' => 2048]),
        ];
    }
}

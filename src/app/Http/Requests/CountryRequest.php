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
            'name' => 'required|min:4|max:50|unique:countries,name,' . $this->id . ',id,deleted_at,NULL',
            'another_name' => 'required|min:4|max:20|unique:countries,another_name,' . $this->id . ',id,deleted_at,NULL',
            'slug' => 'required|unique:countries,slug,' . $this->id . ',id,deleted_at,NULL',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name' => [
                'required' => __('validation.custom.required'),
                'min' => __('validation.custom.min', ['count' => 4]),
                'max' => __('validation.custom.max', ['count' => 50]),
                'unique' => __('validation.custom.unique'),
            ],
            'another_name' => [
                'required' => __('validation.custom.required'),
                'min' => __('validation.custom.min', ['count' => 4]),
                'max' => __('validation.custom.max', ['count' => 20]),
                'unique' => __('validation.custom.unique'),
            ],
            'slug' => [
                'required' => __('validation.custom.required'),
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

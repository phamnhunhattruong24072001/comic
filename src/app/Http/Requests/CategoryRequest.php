<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'min:4',
                'max:50',
                'unique:categories,name,' . $this->id . ',id,deleted_at,NULL',
            ],
            'slug' => [
                'required',
                'unique:categories,slug,' . $this->id . ',id,deleted_at,NULL',
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
            'slug.required' => __('validation.custom.required'),
            'slug.unique' => __('validation.custom.unique'),
        ];
    }
}

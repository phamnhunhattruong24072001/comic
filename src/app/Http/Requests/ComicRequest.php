<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:4',
                'max:50',
                'unique:comics,name,' . $this->id . ',id,deleted_at,NULL',
            ],
            'name_another' => [
                'nullable',
                'min:4',
                'max:50',
                'unique:comics,name_another,' . $this->id . ',id,deleted_at,NULL',
            ],
            'slug' => [
                'required',
                'unique:comics,slug,' . $this->id . ',id,deleted_at,NULL',
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
            'name_another.min' => __('validation.custom.min', ['count' => 4]),
            'name_another.max' => __('validation.custom.max', ['count' => 50]),
            'name_another.unique' => __('validation.custom.unique'),
            'slug.required' => __('validation.custom.required'),
            'slug.unique' => __('validation.custom.unique'),
        ];
    }
}

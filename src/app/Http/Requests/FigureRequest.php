<?php

namespace App\Http\Requests;

use App\Models\Figure;
use Illuminate\Foundation\Http\FormRequest;

class FigureRequest extends FormRequest
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
            'comics' => [
                'required',
            ],
            'age' => [
                'nullable',
                'numeric',
            ],
            'name' => [
                'required',
                'min:2',
                'max:100',
            ],
            'slug' => [
                'required',
                'min:2',
                'max:100',
                'unique:figures,slug,' . $this->id . ',id,deleted_at,NULL'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => __('validation.custom.min', ['count' => 2]),
            'name.max' => __('validation.custom.max', ['count' => 100]),
            'name.required' => __('validation.custom.required'),
            'comics.required' => __('validation.custom.required'),
            'slug.min' => __('validation.custom.min', ['count' => 2]),
            'slug.max' => __('validation.custom.max', ['count' => 100]),
            'slug.required' => __('validation.custom.required'),
            'slug.unique' => __('validation.custom.unique'),
        ];
    }
}

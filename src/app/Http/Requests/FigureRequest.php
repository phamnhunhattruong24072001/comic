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
            'comic_id' => [
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
                function ($attribute, $value, $fail) {
                    $figure = Figure::where('name', $value)
                        ->where('comic_id', $this->comic_id)
                        ->first();

                    if ($figure && $figure->id != $this->id) {
                        $fail(__('validation.custom.unique'));
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => __('validation.custom.min', ['count' => 2]),
            'name.max' => __('validation.custom.max', ['count' => 100]),
            'name.required' => __('validation.custom.required'),
            'comic_id.required' => __('validation.custom.required'),
            'comic_id.numeric' => __('validation.custom.numeric'),
        ];
    }
}

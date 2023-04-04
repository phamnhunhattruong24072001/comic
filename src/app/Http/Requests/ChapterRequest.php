<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
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
            'name' => [
                'nullable',
                'min:2',
                'max:100',
            ],
            'number_chapter' => [
                'required',
                function ($attribute, $value, $fail) {
                    $chapter = Chapter::where('number_chapter', $value)
                        ->where('comic_id', $this->comic_id)
                        ->first();

                    if ($chapter && $chapter->id != $this->id) {
                        $fail(__('validation.custom.unique'));
                    }
                },
            ],
            'slug' => [
                'required',
                'max:100',
                function ($attribute, $value, $fail) {
                    $chapter = Chapter::where('slug', $value)
                        ->where('comic_id', $this->comic_id)
                        ->first();

                    if ($chapter && $chapter->id != $this->id) {
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
            'slug.max' => __('validation.custom.max', ['count' => 100]),
            'name_another.required' => __('validation.custom.required'),
            'slug.required' => __('validation.custom.required'),
            'number_chapter.required' => __('validation.custom.required'),
            'comic_id.required' => __('validation.custom.required'),
        ];
    }
}

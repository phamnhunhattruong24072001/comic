<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $id;

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
            'name' => 'required|min:6|max:50',
            'username' => 'required|min:6|max:20|unique:users,name,' . $this->id . ',id,deleted_at,NULL',
            'email' => 'required|email|unique:users,email,' . $this->id . ',id,deleted_at,NULL',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.custom.required'),
            'name.min' => __('validation.custom.min', ['count' => 6]),
            'name.max' => __('validation.custom.max', ['count' => 50]),
            'username.required' => __('validation.custom.required'),
            'username.min' => __('validation.custom.min', ['count' => 6]),
            'username.max' => __('validation.custom.max', ['count' => 20]),
            'username.unique' => __('validation.custom.unique'),
            'email.required' => __('validation.custom.required'),
            'email.email' => __('validation.custom.email'),
            'email.unique' => __('validation.custom.unique'),
        ];
    }
}

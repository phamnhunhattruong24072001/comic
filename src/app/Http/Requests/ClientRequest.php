<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * @var mixed
     */
    public $remember_me;

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
            ],
            'email' => [
                'required',
            ],
            'username' => [
                'required',
                'unique:clients,username,' . $this->id . ',id,deleted_at,NULL',
            ],
            'password' => [
                'required',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.custom.required'),
            'username.unique' => __('validation.custom.unique'),
            'username.required' => __('validation.custom.required'),
            'password.required' => __('validation.custom.required'),
        ];
    }
}

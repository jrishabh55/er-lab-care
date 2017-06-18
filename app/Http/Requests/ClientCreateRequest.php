<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientCreateRequest extends FormRequest
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
            'name' => 'required|between:2,50',
            'username' => 'required|unique:clients|between:6,20',
            'email' => 'required|unique:clients|email',
            'number' => 'required|unique:clients|integer',
            'lab_name' => 'string|between:3,50',
        ];
    }
}

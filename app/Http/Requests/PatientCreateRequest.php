<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->ownLab($this->input('lab_id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string,between:2,50',
            'email' => 'required|email',
            'number' => 'required|integer|unique:patients|digits_between:8,12',
            'lab_id' => 'required|integer',
            'gender' => 'required|boolean',
            'dob' => 'required|date',
            'address' => 'required|string',
            'referred_by' => 'between:3,50'
        ];
    }
}

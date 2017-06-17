<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientUpdateRequest extends FormRequest
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
            'name' => 'string,between:2,50',
            'email' => 'email',
            'number' => 'integer|digits_between:8,12',
            'lab_id' => 'integer',
            'gender' => 'boolean',
            'dob' => 'date',
            'address' => 'string',
            'referred_by' => 'between:3,50'
        ];
    }
}

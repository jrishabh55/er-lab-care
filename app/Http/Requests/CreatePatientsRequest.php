<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePatientsRequest extends FormRequest
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
            'price' => 'required|float|min:0',
            'discount' => 'required|float|min:0',
            'paid_amount' => 'required|float|min:0',
            'paid' => 'boolean',
            'reference_by' => 'string',
            'printed' => 'boolean',
            'with_tests' => 'boolean',
            'tests.*.test_id' => 'required_if:with_tests,true|integer|min:1',
            'tests.*.value' => 'required_if:with_tests,true|float|min:0',
            'tests.*.price' => 'required_if:with_tests,true|float|min:0',
        ];
    }
}

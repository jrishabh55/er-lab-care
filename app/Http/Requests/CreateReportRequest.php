<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'discount' => 'float|min:0',
            'paid_amount' => 'required|float|min:0',
            'paid' => 'required|boolean',
            'reference_by' => 'string|min:3',
            'printed' => 'required|boolean',
            'with_tests' => 'boolean',
            'tests.*.test_id' => 'required_if:with_tests,true|integer|min:1|distinct',
            'tests.*.value' => 'required_if:with_tests,true|float|min:1',
            'tests.*.price' => 'required_if:with_tests,true|float|min:1',
        ];
    }
}

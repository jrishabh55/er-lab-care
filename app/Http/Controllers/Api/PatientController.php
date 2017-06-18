<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientCreateRequest;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function response;

class PatientController extends Controller
{
    public function listAll()
    {
        return response()->api(Auth::user()->patients()->with('lab', 'reports.tests')->get());
    }

    public function patient(Patient $id)
    {
        return response()->api($id->load('lab', 'reports.tests'));
    }

    public function reports(Patient $id)
    {
        return response()->api([
            $id->number => $id->reports()->with('tests')->get()
        ]);
    }

    public function create(PatientCreateRequest $request)
    {
        $response = Patient::create($request->only('name', 'email', 'number', 'lab_id', 'gender', 'dob', 'address', 'referred_by'));
        return response()->api($response);
    }

    public function update(Request $request, Patient $id)
    {
        $id->update($request->only('name', 'email', 'number', 'lab_id', 'gender', 'dob', 'address'));
        return response()->api($id->load('labs'));
    }
}

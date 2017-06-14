<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function listAll()
    {
        return Auth::user()->patients()->with('lab', 'reports.tests')->get();
    }

    public function patient(Patient $patient)
    {
        return $patient->load('lab', 'reports.tests');
    }

    public function reports(Patient $patient)
    {
        return $patient->reports()->with('tests')->get();
    }
}

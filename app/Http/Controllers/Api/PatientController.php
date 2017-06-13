<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Patient;

class PatientController extends Controller
{
    public function listAll()
    {
        return Patient::with('reports.tests')->first();
    }
}

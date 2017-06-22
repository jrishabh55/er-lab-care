<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListPatientReportsRequest;
use App\Http\Requests\PatientCreateRequest;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function response;

class PatientController extends Controller
{
    public function listAll()
    {
        return response()->json(Auth::guard('client_api')->user()->patients()->with('lab', 'reports.tests')->get());
    }

    public function patient(Request $request, Patient $id)
    {
        return response()->json($id->load('lab', 'reports.tests'));
    }

    public function reports(Request $request, Patient $id)
    {
        $printed = $request->input('printed', false);
        return response()->json($id->reports()->with('tests')->where('patient_reports.printed', $printed)->get());
    }

    public function create(PatientCreateRequest $request)
    {
        $response = Patient::create($request->only('name', 'email', 'number', 'lab_id', 'gender', 'dob', 'address', 'referred_by'));
        return response()->json($response);
    }

    public function update(Request $request, Patient $id)
    {
        $id->update($request->only('name', 'email', 'number', 'lab_id', 'gender', 'dob', 'address'));
        return response()->json($id->load('labs'));
    }

    public function listAllReports(ListPatientReportsRequest $request)
    {

//        return $request->all();
        $reports = Auth::guard('client_api')->user()->patients()->with('reports.tests');

        if ($request->has('printed')) {
            $reports->whereHas('reports', function ($query) use ($request) {
                $query->where('printed', $request->input('printed'));
            });
        }

        if ($request->has('today') && $request->input('today') == true) {
            $reports->whereHas('reports', function ($query) use ($request) {
                $query->where('created_at', '>=', Carbon::today());
            });
        }

        return response()->json($reports->get());
    }

}

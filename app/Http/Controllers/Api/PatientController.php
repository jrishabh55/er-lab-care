<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePatientsRequest;
use App\Http\Requests\ListPatientReportsRequest;
use App\Http\Requests\PatientCreateRequest;
use App\Patient;
use App\PatientReport;
use App\PatientTest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function response;

class PatientController extends Controller
{
    public function listAll(Request $request)
    {
        $this->validate($request, [
            'with_lab' => 'boolean',
            'with_reports' => 'boolean',
        ]);

        $with = [];

        if ($request->has('with_lab') && $request->input('with_lab') == true)
            $with[] = 'lab';
        if ($request->has('with_reports') && $request->input('with_reports') == true)
            $with[] = 'reports.tests';

        return response()->json(Auth::guard('client_api')->user()->patients()->with($with)->get());
    }

    public function patient(Request $request, Patient $id)
    {
        $this->validate($request, [
            'with_lab' => 'boolean',
            'with_reports' => 'boolean',
        ]);

        $with = [];

        if ($request->has('with_lab') && $request->input('with_lab') == true)
            $with[] = 'lab';
        if ($request->has('with_reports') && $request->input('with_reports') == true)
            $with[] = 'reports.tests';

        return response()->json($id->load($with));
    }

    public function reports(Request $request, Patient $id)
    {
        $printed = $request->input('printed', false);
        return response()->json($id->reports()->with('tests')->where('patient_reports.printed', $printed)->get());
    }

    public function createReport(CreatePatientsRequest $request, Patient $id)
    {
        $report = new PatientReport;
        $report->price = $request->input('price');
        $report->discount = $request->input('discount', 0);
        $report->paid_amount = $request->input('paid_amount');
        $report->paid = $request->input('paid_amount') == $request->input('price') - $request->input('discount', 0);
        $report->reference_by = $request->input('reference_by', null);
        $report->printed = $request->input('printed', false);

        $id->reports()->save($report);

        if ($request->input('with_tests')) {
            foreach ($request->input('tests') as $test) {
                $instance = new PatientTest;
                $instance->value = $test['value'];
                $instance->price = $test['price'];
                $instance->test_id = $test['test_id'];
                $report->tests()->save($instance);
            }
        }
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function response;

class LabController extends Controller
{

    public function view(Request $request, Lab $id)
    {
        $id = $request->has('with_owner') && $request->input('with_owner') == true ? $id->load('owner') : $id;
        return response()->json($id);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'lab_name' => 'required|string|between:2,50',
        ]);

        $lab = new Lab;
        $lab->name = $request->input('lab_name');
        $lab = $request->user('client_api')->labs()->save($lab);

        return response()->json($lab);
    }

    public function update(Request $request, Lab $id)
    {
        $this->validate($request, [
            'lab_name' => 'required|string|between:2,50',
        ]);
        return response()->json($id->update(['name' => $request->input('lab_name')]));
    }

    public function listAll()
    {
        return response()->json(Auth::guard('client_api')->user()->labs()->get());
    }

    public function reports(Request $request, Lab $id)
    {
        $patients = $id->patients();


        if ($request->has('patient_limit'))
            $patients = $patients->limit($request->input('patient_limit'));

        $patients = $patients->orderByDesc('patients.id')->with('reports.tests')->get();

        return response()->json($patients);
    }
}

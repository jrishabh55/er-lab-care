<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lab;
use Illuminate\Http\Request;
use function response;

class LabController extends Controller
{

    public function listAll(Request $request)
    {
        return response()->api($request->user()->labs()->get());
    }

    public function reports(Request $request, Lab $id)
    {
        $patients = $id->patients()->with('reports.tests');

        if ($request->has('limit'))
            $patients->limit($request->input('limit'));

        $patients->get();

        return response()->api($patients);
    }

}

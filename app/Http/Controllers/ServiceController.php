<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function view()
    {
        return view('licence.list', ['licences' => Auth::guard('client_web')->user()->licences]);
    }
}

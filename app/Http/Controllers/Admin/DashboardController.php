<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use function view;

class DashboardController extends Controller
{
    function __construct()
    {
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

}

<?php

namespace App\Http\Controllers;

use function redirect;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->action('ServiceController@view');
    }
}

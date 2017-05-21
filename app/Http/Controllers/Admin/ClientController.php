<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    function __construct()
    {

    }

    public function show()
    {
        return view('admin.clients', ['clients' => Client::all()]);
    }
}

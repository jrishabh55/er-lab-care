<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientSoftwareLogin;
use App\Licence;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $client = new Client;
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->number = $request->input('number');
        $client->ip_registered = $request->ip();

        $client->save();

        $licence = Licence::where('value', $request->input('licence'));
        $licence->device_id = $request->input('device_id');
        $licence->hdd_id = $request->input('hdd_id');
        $licence->mac_address = $request->input('mac_address');
        $licence->longitude = $request->input('longitude');
        $licence->latitude = $request->input('latitude');
        $client->licences()->save($licence);
    }

    public function login(ClientSoftwareLogin $request)
    {
        $licence = $request->input('licence');

    }
}

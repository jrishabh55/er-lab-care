<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function response;

class ClientController extends Controller
{
    public function create(ClientCreateRequest $request)
    {
        try {
            $response = Client::create($request->only('name', 'email', 'username', 'number'));

            $lab = new Lab;
            $lab->name = $request->input('lab_name', 'Lab 1');
            $response->labs()->save($lab);

            return response()->json($response->load('labs'));
        } catch (\Exception $e) {
            return response()->json([$e->getMessage()], $e->getCode());
        }
    }

    public function update(ClientUpdateRequest $request, Client $id)
    {
        return response()->json($id->update($request->only('email', 'number', 'name')));
    }

    public function login(Request $request)
    {
        if (Auth::guard('client_web')->attempt($request->only('username', 'password'))) {
            $user = Auth::guard('client_web')->user();

            if ($user->hasFreeLicences()) {
                $licence = $user->getFreeLicence();
                if ($licence->activate($request->only('mac', 'hdd', 'device_id', 'latitude', 'longitude'))) {
                    $usr = $user->makeVisible('api_token')->toArray();
                    return response()->json($usr + ['licence' => $licence->value]);
                }
            }
        }
        return response()->json(['error' => 'Un-Authenticated'], 401);
    }
}

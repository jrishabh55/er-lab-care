<?php

namespace App\Http\Controllers\Api;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Lab;
use function response;
use function str_random;

class ClientController extends Controller
{
    public function create(ClientCreateRequest $request)
    {
        try {
            $arr = [
                'ip_registered' => $request->ip(),
                'api_token' => str_random(255),
            ];
            $responce = (Client::create($request->only('name', 'email', 'username', 'number') + $arr));
            $lab = new Lab;
            $lab->name = $request->input('lab_name', 'Lab 1');
            $responce->labs()->save($lab);

            return response()->api($responce->load('labs')->makeVisible('id'));
        } catch (\Exception $e) {
            return response()->api($e->getMessage(), $e->getCode(), true);
        }
    }

    public function update(ClientUpdateRequest $request, Client $id)
    {
        return response()->api($id->update($request->only('email', 'number', 'name')));
    }
}

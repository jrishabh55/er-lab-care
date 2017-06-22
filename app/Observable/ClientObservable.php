<?php

namespace App\Observable;


use Illuminate\Support\Facades\Request;

class ClientObservable
{
    public function creating($client)
    {
        $client->ip_registered = Request::ip();
        $client->api_token = str_random(128);
    }
}
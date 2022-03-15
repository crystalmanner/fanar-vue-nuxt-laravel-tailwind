<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class CurrencyController extends Controller
{
    public function index()
    {
        $content = Cache::remember('users', 86400, function () {
            $client = new Client();
            $response = $client->request('GET', 'http://apilayer.net/api/live?access_key=dbdb1047ea4ef274373299e23c946c05');

            return $response->getBody()->getContents();
        });

        return response(json_decode($content, true));
    }
}

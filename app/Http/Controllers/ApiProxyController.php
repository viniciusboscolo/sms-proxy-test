<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class ApiProxyController extends Controller
{
    
    private $baseUrl = 'https://postback-sms.com/api/';


    public function getNumber(Request $request)
    {
        $token = $request->query('token');
        if (!$token) {
            return response()->json(['code' => 'error', 'message' => 'Token not provided'], 400);
        }

        $response = Http::get($this->baseUrl, [
            'action' => 'getNumber',
            'country' => 'se',
            'service' => 'wa',
            'token' => $token,
            'rent_time' => 4, 
        ]);

        return $response->json();
    }

    public function getSms(Request $request)
    {
        $token = $request->query('token');
        $activation = $request->query('activation');

        if (!$token) {
            return response()->json(['code' => 'error', 'message' => 'Token not provided'], 400);
        }

        if (!$activation) {
            return response()->json(['code' => 'error', 'message' => 'Activation ID not provided'], 400);
        }

        $response = Http::get($this->baseUrl, [
            'action' => 'getSms',
            'token' => $token,
            'activation' => $activation,
        ]);

        return $response->json();
    }

 
    public function cancelNumber(Request $request)
    {
        $token = $request->query('token');
        $activation = $request->query('activation');

        if (!$token) {
            return response()->json(['code' => 'error', 'message' => 'Token not provided'], 400);
        }

        if (!$activation) {
            return response()->json(['code' => 'error', 'message' => 'Activation ID not provided'], 400);
        }

        $response = Http::get($this->baseUrl, [
            'action' => 'cancelNumber',
            'token' => $token,
            'activation' => $activation,
        ]);

        return $response->json();
    }

    public function getStatus(Request $request)
    {
        $token = $request->query('token');
        $activation = $request->query('activation');

        if (!$token) {
            return response()->json(['code' => 'error', 'message' => 'Token not provided'], 400);
        }

        if (!$activation) {
            return response()->json(['code' => 'error', 'message' => 'Activation ID not provided'], 400);
        }

        $response = Http::get($this->baseUrl, [
            'action' => 'getStatus',
            'token' => $token,
            'activation' => $activation,
        ]);

        return $response->json();
    }
}

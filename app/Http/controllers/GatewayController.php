<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GatewayController extends Controller
{
    //
    public function forwardToPatientService(Request $request)
    {
        // Forward request to User Service
        $response = Http::withToken($request->bearerToken())
                        ->get('http://patient-service/api/users/' . $request->id);

        return response()->json($response->json(), $response->status());
    }

    public function forwardToMaladieService(Request $request)
    {
        // Forward request to Order Service
        $response = Http::withToken($request->bearerToken())
                        ->get('http://maladie-service/api/orders/' . $request->id);

        return response()->json($response->json(), $response->status());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AksesOfficesController extends Controller
{
    public function memanggilAPIGetAlldata()
    {
        $token = '4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2';
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->get('http://localhost/1201220037/public/api/offices');

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiGetById($officeCode)
    {
        $token = '4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2';
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->get('http://localhost/1201220037/public/api/offices/' . $officeCode);

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiInsert(Request $request)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->post('http://localhost/1201220037/public/api/offices', $request->all());

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiUpdate(Request $request, $officeCode)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->put('http://localhost/1201220037/public/api/offices/' . $officeCode, $request->all());

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiDelete($officeCode)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->delete('http://localhost/1201220037/public/api/offices/' . $officeCode);

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }
}

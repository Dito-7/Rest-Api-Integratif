<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AksesOrdersController extends Controller
{
    public function memanggilApiGetAllData()
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->get('http://localhost/1201220037/public/api/orders');

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiGetById($id)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->get('http://localhost/1201220037/public/api/orders/' . $id);

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiInsert(Request $request)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";
        $data = $request->all();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost/1201220037/public/api/orders', $data);

        return $response->json();
    }

    public function memanggilApiUpdate(Request $request, $orderNumber)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])
            ->put('http://localhost/1201220037/public/api/orders/' . $orderNumber, $request->all());

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiDelete($orderNumber)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->delete('http://localhost/1201220037/public/api/orders/' . $orderNumber);

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }
}

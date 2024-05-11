<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class AksespaymentsController extends Controller
{
    public function memanggilApiGetAllData()
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->get('http://localhost/1201220037/public/api/payments');

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
            ->get('http://localhost/1201220037/public/api/payments/' . $id);

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
            ->post('http://localhost/1201220037/public/api/payments', $request->all());

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiUpdate(Request $request, $customerNumber, $checkNumber)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token
        ])
            ->put('http://localhost/1201220037/public/api/payments/' . $customerNumber . '/' . $checkNumber, $request->all());

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }

    public function memanggilApiDelete($customerNumber, $checkNumber)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])
            ->delete('http://localhost/1201220037/public/api/payments/' . $customerNumber . '/' . $checkNumber);

        $jsonData = $response->json();

        return response()->json($jsonData, $response->getStatusCode());
    }
}

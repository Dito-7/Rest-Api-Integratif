<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class AksesOrderdetailsController extends Controller
{
    public function memanggilApiGetAllData()
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $request = Request::create('/api/orderdetails', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = Route::dispatch($request);
        return $response;
    }

    public function memanggilApiGetById($id)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $url = '/api/orderdetails/' . $id;

        $request = Request::create($url, 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = Route::dispatch($request);
        return $response;
    }

    public function memanggilApiInsert(Request $request)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";
        $data = $request->all();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost/1201220037/public/api/orderdetails', $data);

        return $response->json();
    }

    public function memanggilApiUpdate(Request $request, $orderNumber, $productCode)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";
        $data = $request->all();

        $url = 'http://localhost/1201220037/public/api/orderdetails/' . $orderNumber . '/' . $productCode;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->put($url, $data);

        return $response->json();
    }

    public function memanggilApiDelete($orderNumber, $productCode)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $url = 'http://localhost/1201220037/public/api/orderdetails/' . $orderNumber . '/' . $productCode;

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->delete($url);

        return $response->json();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

class AksesProductLinesController extends Controller
{
    public function memanggilApiGetAllData()
    {
        // $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        // $response = Http::withHeaders([
        //     'Accept' => 'application/json',
        //     'Authorization' => 'Bearer ' . $token
        // ])->get('1201220037/api/productlines');

        // return $response->json();
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $request = Request::create('/api/productlines', 'GET');
        $request->headers->set('Authorization', 'Bearer ' . $token);
        $response = Route::dispatch($request);
        return $response;
    }

    public function memanggilApiGetById($id)
    {
        //     $token = "2|oPHXI4aloqOjTwqI35TTiIelCbYdCumFdRhn9flI90bda888";
        //     $response = Http::withHeaders([
        //         'Accept' => 'application/json',
        //         'Authorization' => 'Bearer ' . $token
        //     ])
        //         ->get('1201220445/api/productlines/' . $key);

        //     $jsonData = $response->json();

        //     return response()->json($jsonData, $response->getStatusCode());

        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $url = '/api/productlines/' . $id;

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
        ])->post('http://localhost/1201220037/public/api/productlines', $data);

        return $response->json();
    }

    public function memanggilApiUpdate(Request $request, $id)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";
        $data = $request->all();

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->put('http://localhost/1201220037/public/api/productlines/' . $id, $data);

        return $response->json();
    }

    public function memanggilApiDelete($id)
    {
        $token = "4|vXvpSSOgZUgWMUWqNK9Eu0zY4pLen1roKZnvZObx6c521cb2";

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->delete('http://localhost/1201220037/public/api/productlines/' . $id);

        return $response->json();
    }
}

<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\OfficesController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ProductlinesController;
use App\Http\Controllers\OrderdetailsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

route::get('getAllUsers', [UserController::class, 'getUsers']);
route::get('getAllUsersToo', [UserController::class, 'getUsers'])->middleware('auth:sanctum');
route::get('CallApiWithToken', [ApiController::class, 'memanggilApi']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('collections', CollectionController::class);
});

Route::resource('orderdetails', OrderdetailsController::class);
Route::put('orderdetails/{orderNumber}/{productCode}', [OrderdetailsController::class, 'update']);
Route::delete('orderdetails/{orderNumber}/{productCode}', [OrderdetailsController::class, 'destroy']);

Route::resource('productlines', ProductlinesController::class);
Route::resource('employees', EmployeesController::class);
Route::resource('products', ProductController::class);
Route::resource('customers', CustomersController::class);
Route::resource('orders', OrdersController::class);
Route::resource('payments', PaymentsController::class);
Route::put('payments/{customerNumber}/{checkNumber}', [PaymentsController::class, 'update']);
Route::delete('payments/{customerNumber}/{checkNumber}', [PaymentsController::class, 'destroy']);
Route::resource('offices', OfficesController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/hello', function () {
    return "Hello World!";
});
<?php

use App\Http\Controllers\AksesOfficesController;
use App\Http\Controllers\AksesProductLinesController;
use App\Http\Controllers\AksesOrderdetailsController;
use App\Http\Controllers\AksesEmployeesController;
use App\Http\Controllers\AksesProductController;
use App\Http\Controllers\AksesCustomersController;
use App\Http\Controllers\AksesOrdersController;
use App\Http\Controllers\AksespaymentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('callApiWithToken', [ApiController::class, 'memanggilApi']);

Route::get('callApiGetAllData', [AksesOfficesController::class, 'memanggilApiGetAllData']);
Route::get('callApiGetById/{id}', [AksesOfficesController::class, 'memanggilApiGetById']);
Route::get('callApiPost', [AksesOfficesController::class, 'memanggilApiInsert']);
Route::get('callApiUpdate/{id}', [AksesOfficesController::class, 'memanggilApiUpdate']);
// Route::get('callApiUpdate/{customerNumber}/{checkNumber}', [AksesOfficesController::class, 'memanggilApiUpdate']);
Route::get('callApiDelete/{id}', [AksesOfficesController::class, 'memanggilApiDelete']);
// Route::get('callApiDelete/{customerNumber}/{checkNumber}', [AksesOfficesController::class, 'memanggilApiDelete']);

Route::get('/', function () {
    return view('welcome');
});

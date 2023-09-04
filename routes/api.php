<?php

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/list', [RouteController::class, 'get']);
Route::get('category/list', [RouteController::class, 'get']);
Route::get('category/list/{id}', [RouteController::class, 'categoryDetails']);
Route::post('create/category', [RouteController::class, 'createCategory']);
Route::post('create/contact', [RouteController::class, 'createContact']);
Route::post('category/delete', [RouteController::class, 'deleteCategory']);
Route::post('category/list/{id}/update', [RouteController::class, 'categoryUpdate']);

<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//FETCH FROM ENDPOINT
Route::get('external-books', [BookController::class, 'fetchbooks']);

//POST, GET, PUT, DELETE, SHOW DATA FOR LOCAL STORAGE
Route::post('v1/books', [BookController::class, 'postLocalbooks']);
Route::get('v1/books', [BookController::class, 'fetchLocalbooks']);
Route::patch('v1/books/:{id}', [BookController::class, 'patchLocalbooks']);
Route::delete('v1/books/:{id}', [BookController::class, 'deleteLocalbooks']);
Route::get('v1/books/:{id}', [BookController::class, 'fetchSingleLocalbooks']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



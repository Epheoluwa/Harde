<?php

use App\Http\Controllers\FrontEndBookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontEndBookController::class, 'index'])->name('index');
Route::delete('delete-record/{id}', [FrontEndBookController::class, 'deleterecord']);
Route::put('edit-record/{id}', [FrontEndBookController::class, 'editrecord']);
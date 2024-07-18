<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PeminjamanController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('books', [BooksController::class, 'index']);

Route::get('members', [MembersController::class, 'index']);

Route::post('peminjaman', [PeminjamanController::class, 'borrow']);
Route::patch('peminjaman', [PeminjamanController::class, 'return']);
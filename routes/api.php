<?php

use App\Http\Controllers\PeopleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('users',[PeopleController::class, 'index']);
Route::get('users/{id}',[PeopleController::class, 'show']);
Route::post('addnew',[PeopleController::class, 'store']);
Route::put('usersupdate/{id}', [PeopleController::class, 'update']);
Route::delete('usersdelete/{id}', [PeopleController::class, 'destroy']);

<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('test', function () {
  return response()->json(['message' => 'Hello World!']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/user/subjects', [SubjectController::class, 'subjectsByLoggedUser']);
  Route::apiResource('/subjects', SubjectController::class);
  Route::apiResource('/cards', CardController::class);
});

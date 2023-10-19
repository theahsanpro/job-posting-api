<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\JobController;

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

Route::get('jobs', [JobController::class, 'GetJobs']);
Route::post('jobs', [JobController::class, 'PostJob']);
Route::get('jobs/{id}', [JobController::class, 'GetJob']);
Route::put('jobs/{id}', [JobController::class, 'UpdateJob']);
Route::delete('jobs/{id}', [JobController::class, 'DeleteJob']);
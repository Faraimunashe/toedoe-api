<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\CompleteTaskController;
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

Route::prefix('v1')->group(function(){
    /* API AUTHENTICATION ROUTES */
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);


    /* API PROTECTED ROUTES */
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('verify', [AuthController::class, 'verify']);

        Route::apiResource('tasks', TaskController::class);
        Route::put('tasks/{id}/complete', [CompleteTaskController::class, 'update']);
    });

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

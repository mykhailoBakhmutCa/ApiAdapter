<?php

use App\Http\Controllers\Api\V1\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function() {
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employees', 'index');
        Route::post('/employees', 'store');
        Route::patch('/employees/{id}', 'update');
    });
});

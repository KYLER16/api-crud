<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EmployeeController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('employee',[EmployeeController::class,'index']);
Route::post('employee',[EmployeeController::class,'store']);
Route::get('employee/{id}', [EmployeeController::class,'show']);
Route::get('employee/{id}/edit', [EmployeeController::class,'edit']);
Route::put('employee/{id}/edit', [EmployeeController::class,'update']);
Route::delete('employee/{id}/delete', [EmployeeController::class,'destroy']);                  
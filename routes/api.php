<?php

use App\Http\Controllers\Employee\EmployeeController;
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

// Route::post('employee', [EmployeeController::class, 'importEmployees'])->name('employee-import');
// Route::delete('employee/{id}', [EmployeeController::class, 'destroy']);
// Route::resource('employee', EmployeeController::class)->only(['index', 'show','destroy']);
Route::resource('employee',EmployeeController::class)->only([
    'index', 'show','destroy','store'
]);
 
Route::resource('employee', EmployeeController::class)->except([
    'update','create'
]);
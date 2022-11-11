<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// User
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('getUsers', [UserController::class, 'getUsers']);
Route::delete('deleteUser/{id}', [UserController::class, 'deleteUser']);
Route::delete('updateUser/{id}', [UserController::class, 'updateUser']);

// Department
Route::post('addDepartment', [DepartmentController::class, 'addDepartment']);
Route::get('getDepartments', [DepartmentController::class, 'getDepartments']);
Route::delete('deleteDepartment/{id}', [DepartmentController::class, 'deleteDepartment']);
Route::post('updateDepartment/{id}', [DepartmentController::class, 'updateDepartment']);

// Designation
Route::post('addDesignation', [DesignationController::class, 'addDesignation']);
Route::get('getDesignations', [DesignationController::class, 'getDesignations']);
Route::delete('deleteDesignation/{id}', [DesignationController::class, 'deleteDesignation']);
Route::post('updateDesignation/{id}', [DesignationController::class, 'updateDesignation']);

// Leave
Route::post('addLeave', [LeaveController::class, 'addLeave']);
Route::get('getLeaves', [LeaveController::class, 'getLeaves']);
Route::delete('deleteLeave/{id}', [LeaveController::class, 'deleteLeave']);
Route::post('updateLeave/{id}', [LeaveController::class, 'updateLeave']);

<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use App\Models\Department;
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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('all_user', [UserController::class, 'all_user']);
Route::delete('delete_user/{id}', [UserController::class, 'delete_user']);

Route::get('ict', [UserController::class, 'ict']);

// Department
Route::post('addDepartment', [DepartmentController::class, 'addDepartment']);
Route::get('getDepartments', [DepartmentController::class, 'getDepartments']);
Route::delete('deleteDepartment/{id}', [DepartmentController::class, 'deleteDepartment']);
Route::post('updateDepartment/{id}', [DepartmentController::class, 'updateDepartment']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;

/*
|--------------------------------------------------------------------------
| Web Routes 
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('student', [studentController::class, 'index']);
Route::get('student_data', [studentController::class, 'student_data']);
Route::post('addstudent', [studentController::class, 'addstudent']);
Route::get('edit_data/{id}', [studentController::class, 'editdata']);
Route::post('editsubmit', [studentController::class, 'editsubmit']);
Route::get('delete_data/{id}', [studentController::class, 'deletedata']);
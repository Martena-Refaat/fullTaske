<?php

use App\Http\Controllers\student\authStudentController;
use App\Http\Controllers\student\studentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});





Route :: get('Students',[studentController :: class , 'index']);

Route :: get('Students/Create',[studentController :: class , 'create']);
Route :: post('Students/Store',[studentController :: class , 'store']);
Route :: get('Student/edit/{id}',[studentController :: class , 'edit']);
Route :: put('Student/update/{id}',[studentController :: class , 'update']);
Route :: get('Students/Delete/{id}',[studentController :: class , 'remove']);



Route :: get('Login',[authStudentController :: class , 'login']);
Route :: post('DOLogin',[authStudentController :: class , 'doLogin']);
Route :: get('Logout',[authStudentController :: class , 'Logout']);



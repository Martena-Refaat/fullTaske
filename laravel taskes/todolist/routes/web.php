<?php
use App\Http\Controllers\users\authcontroller;

use App\Http\Controllers\users\userController;
use App\Http\Controllers\taskController;

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

Route::middleware('userCheck')->group(function(){

Route :: get('Users',[userController :: class , 'index']);
Route :: get('Users/edit/{id}',[userController :: class , 'edit']);
Route :: put('Users/update/{id}',[userController :: class , 'update']);
Route :: get('Users/Delete/{id}',[userController :: class , 'remove']);
Route :: resource('Taskes',taskController::class);


});
Route :: get('Users/Create',[userController :: class , 'create']);
Route :: post('Users/Store',[userController :: class , 'store']);
Route :: get('Login',[authcontroller :: class , 'login']);
Route :: post('DOLogin',[authcontroller :: class , 'doLogin']);
Route :: get('Logout',[authcontroller :: class , 'Logout']);


##################################################################





/*
    /Taskes        (GET)       >>>   Route::get('Blogs',[blogController :: class , 'index']);
    /Taskes/create (GET)       >>>   Route::get('Blogs/create',[blogController :: class , 'create']);
    /Taskes        (POST)      >>>   Route::post('Blogs',[blogController :: class , 'store']);
    /Taskes/{id}   (GET)       >>>   Route::get('Blogs/{id}',[blogController :: class , 'show']);
    /Taskes/{id}/edit (GET)    >>>   Route::get('Blogs/{id}/edit',[blogController :: class , 'edit']);
    /Taskes/{id}   (PUT)       >>>   Route::put('Blogs/{id}',[blogController :: class , 'update']);
    /Taskes/{id}   (DELETE)    >>>   Route::delete('Blogs/{id}',[blogController :: class , 'destroy']);
    */


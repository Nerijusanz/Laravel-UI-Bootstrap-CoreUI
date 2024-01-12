<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', function () {
    if (session('status')) return redirect()->route('admin.home')->with('status', session('status'));

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => '\App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {

    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
    Route::resource('users', \App\Http\Controllers\Admin\UsersController::class);
    Route::resource('permissions', \App\Http\Controllers\Admin\PermissionsController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\RolesController::class);

});

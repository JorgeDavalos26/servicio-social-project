<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

/* 
Route::get('/', function () {
    return view('welcome_view');
});
*/

/**
 * Data
 * 
 * Return JSON
 */

Route::prefix('api')->group(function () 
{

    Route::prefix('auth')->group(function ()
    {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('register', [AuthController::class, 'register']);
    });

});

/** 
 * Views
 * 
 * Return HTML
 */

Route::get('/', function () {

    return view('portal_view');

});

Route::get('/gobmx', function () {

    return view('gobmx_view');

})->name('gobmx');


Route::get('/inicio', function () {

    return view('home_view');

})->middleware('auth')->name('home_view');


Route::get('/ingreso', function () {

    if(Auth::check())
    {
        return view('home_view');
    }
    else
    {
        return view('login_view');
    }

})->name('login_view');


Route::get('/registro', function () {
    
    if(Auth::check())
    {
        return view('home_view');
    }
    else
    {
        return view('signup_view');
    }

})->name('signup_view');



<?php

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

/* 
Route::get('/', function () {
    return view('welcome_view');
});
*/

Route::get('/gobmx', function () {
    return view('gobmx_view');
});

Route::get('/', function () {
    return view('portal');
});

Route::get('/inicio', function () {
    return view('inicio');
});

Route::get('/ingreso', function () {
    return view('ingreso');
});

Route::get('/registro', function () {
    return view('registro');
});
<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SolicitudeController;
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

    Route::get('solicitudes', [SolicitudeController::class, 'index']);
    Route::post('solicitudes', [SolicitudeController::class, 'store']);
    Route::get('solicitudes/{solicitude}', [SolicitudeController::class, 'show']);
    Route::put('solicitudes/{solicitude}', [SolicitudeController::class, 'update']);
    Route::delete('solicitudes/{solicitude}', [SolicitudeController::class, 'destroy']);

    Route::get('periods', [PeriodController::class, 'index']);
    Route::post('periods', [PeriodController::class, 'store']);
    Route::get('periods/{period}', [PeriodController::class, 'show']);
    Route::put('periods/{period}', [PeriodController::class, 'update']);
    Route::delete('periods/{period}', [PeriodController::class, 'destroy']);

    Route::get('questions', [QuestionController::class, 'index']);
    Route::post('questions', [QuestionController::class, 'store']);
    Route::get('questions/{question}', [QuestionController::class, 'show']);
    Route::put('questions/{question}', [QuestionController::class, 'update']);
    Route::delete('questions/{question}', [QuestionController::class, 'destroy']);

    Route::get('answers', [AnswerController::class, 'index']);
    Route::post('answers', [AnswerController::class, 'store']);
    Route::get('answers/{answer}', [AnswerController::class, 'show']);
    Route::put('answers/{answer}', [AnswerController::class, 'update']);
    Route::delete('answers/{answer}', [AnswerController::class, 'destroy']);

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

    return view('examples-gobmx.gobmx_view');

})->name('gobmx');

Route::get('/inicio', function () {
    if(!Auth::check()) return view('login_view');
    //if(Auth::user()->is_admin) return view('admin_view');
    return view('home_view');

})->middleware('auth')->name('home_view');

Route::get('/ingreso', function () {

    if(Auth::check()) return redirect()->route('home_view');
    else return view('login_view');

})->name('login_view');

Route::get('/registro', function () {
    
    if(Auth::check()) return redirect()->route('home_view');
    else return view('signup_view');

})->name('signup_view');

Route::get('/perfil', function () {
    
    if(Auth::check()) return view('profile_view');
    else return redirect()->route('login_view');

})->name('profile_view');

Route::get('/formulario', function () {
    
    if(Auth::check()) return view('form_view');
    else return redirect()->route('login_view');

})->name('form_view');
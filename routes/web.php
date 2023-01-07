<?php

use App\Helpers\FormHelper;
use App\Helpers\SettingHelper;
use App\Helpers\SolicitudeHelper;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SolicitudeController;
use App\Http\Middleware\AuthAPI;
use App\Http\Middleware\AuthWeb;
use App\Http\Middleware\GetAuthWeb;
use App\Http\Resources\SolicitudeCompleteResource;
use App\Models\Answer;
use App\Models\Form;
use App\Models\Group;
use App\Models\Period;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Solicitude;
use App\Models\User;
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

Route::prefix('api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('register', [AuthController::class, 'register']);
    });

    Route::middleware([AuthAPI::class])->group(function () {

        Route::get('solicitudes', [SolicitudeController::class, 'index'])->can('index', Solicitude::class);
        Route::post('solicitudes', [SolicitudeController::class, 'store'])->can('store', Solicitude::class);
        Route::get('solicitudes/{solicitude}', [SolicitudeController::class, 'show'])->can('show', 'solicitude');
        Route::put('solicitudes/{solicitude}', [SolicitudeController::class, 'update'])->can('update', 'solicitude');
        Route::put('solicitudes/{solicitude}/toPayment', [SolicitudeController::class, 'updateToWaitingPayment'])->can('update', 'solicitude');
        Route::put('solicitudes/{solicitude}/confirmPayment', [SolicitudeController::class, 'confirmPayment'])->can('confirmPayment', 'solicitude');
        Route::delete('solicitudes/{solicitude}', [SolicitudeController::class, 'destroy'])->can('destroy', 'solicitude');
        Route::get('solicitudes/{solicitude}/complete', [SolicitudeController::class, 'getComplete'])->can('getComplete', 'solicitude');

        Route::get('periods', [PeriodController::class, 'index'])->can('index', Period::class);
        Route::post('periods', [PeriodController::class, 'store'])->can('store', Period::class);
        Route::get('periods/{period}', [PeriodController::class, 'show'])->can('show', 'period');
        Route::put('periods/{period}', [PeriodController::class, 'update'])->can('update', 'period');
        Route::delete('periods/{period}', [PeriodController::class, 'destroy'])->can('destroy', 'period');

        Route::get('forms', [FormController::class, 'index'])->can('index', Form::class);
        Route::post('forms', [FormController::class, 'store'])->can('store', Form::class);
        Route::get('forms/{form}', [FormController::class, 'show'])->can('show', 'form');
        Route::put('forms/{form}', [FormController::class, 'update'])->can('update', 'form');
        Route::delete('forms/{form}', [FormController::class, 'destroy'])->can('destroy', 'form');

        Route::get('questions', [QuestionController::class, 'index'])->can('index', Question::class);
        Route::post('questions', [QuestionController::class, 'store'])->can('store', Question::class);
        Route::get('questions/{question}', [QuestionController::class, 'show'])->can('show', 'question');
        Route::put('questions/{question}', [QuestionController::class, 'update'])->can('update', 'question');
        Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->can('destroy', 'question');

        Route::get('answers', [AnswerController::class, 'index'])->can('index', Answer::class);
        Route::post('answers', [AnswerController::class, 'store'])->can('store', Answer::class);
        Route::post('answers/storeBulk', [AnswerController::class, 'storeBulk'])->can('storeBulk', Answer::class);
        Route::post('answers/{solicitude}/{question}/updateMediaAnswer', [AnswerController::class, 'updateMediaAnswer'])->can('updateMediaAnswer', Answer::class);
        Route::get('answers/{answer}', [AnswerController::class, 'show'])->can('show', 'answer');
        Route::put('answers/{answer}', [AnswerController::class, 'update'])->can('update', 'answer');
        Route::delete('answers/{answer}', [AnswerController::class, 'destroy'])->can('destroy', 'answer');

        Route::get('settings/getActivePeriods', [SettingController::class, 'getActivePeriods'])->can('getActivePeriods', Setting::class);
        Route::put('settings/updateActivePeriods', [SettingController::class, 'updateActivePeriods'])->can('updateActivePeriods', Setting::class);
        Route::get('settings/getActiveForms', [SettingController::class, 'getActiveForms'])->can('getActiveForms', Setting::class);
        Route::put('settings/updateActiveForms', [SettingController::class, 'updateActiveForms'])->can('updateActiveForms', Setting::class);
        Route::get('settings/getReceiveUpcomingSolicitudes', [SettingController::class, 'getReceiveUpcomingSolicitudes'])->can('getReceiveUpcomingSolicitudes', Setting::class);
        Route::put('settings/updateReceiveUpcomingSolicitudes', [SettingController::class, 'updateReceiveUpcomingSolicitudes'])->can('updateReceiveUpcomingSolicitudes', Setting::class);

        Route::get('settings', [SettingController::class, 'index'])->can('index', Setting::class);
        Route::post('settings', [SettingController::class, 'store'])->can('index', Setting::class);
        Route::get('settings/{setting}', [SettingController::class, 'show'])->can('show', 'setting');
        Route::put('settings/{setting}', [SettingController::class, 'update'])->can('update', 'setting');
        Route::delete('settings/{setting}', [SettingController::class, 'destroy'])->can('destroy', 'setting');

        Route::get('groups', [GroupController::class, 'index'])->can('index', Group::class);

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

Route::middleware([GetAuthWeb::class])->group(function () {
    Route::get('/ingreso', function () {
        return view('login_view');
    })->name('login_view');

    Route::get('/registro', function () {
        return view('signup_view');
    })->name('signup_view');
});

Route::middleware([AuthWeb::class])->group(function () {

    Route::get('/gobmx', function () {
        return view('examples-gobmx.gobmx_view');
    })->name('gobmx');

    Route::get('/inicio', function () {

        if (user()->isAdmin()) {
            return view('admin_view');
        } else {
            $parsedForms = FormHelper::parseFormsToSelectElement(SettingHelper::getActiveFormsIds());
            return view('home_view', [
                'forms' => $parsedForms,
                'solicitudes' => SolicitudeController::getSolicitudesOfStudent(Auth::user()->id),
                'userId' => Auth::user()->id
            ]);
        }

    })->name('home_view');

    Route::get('/perfil', function () {
        return view('profile_view');
    })->name('profile_view');

    Route::get('/formulario', function () {
        return view('form_view');
    })->name('form_view');

    Route::get('/solicitud/{id}', function () {
        $solicitudeId = request()->id;

        if (!is_numeric($solicitudeId))
            return redirect()->route('home_view');

        $adminView = false;
        $solicitudeOwner = null;
        $solicitude = Solicitude::find($solicitudeId);
        $solicitudeDeliverable = false;

        if (user()->isAdmin()) {
            $adminView = true;
            $solicitudeOwner = User::find($solicitude['user_id']);
        } else if (!SolicitudeHelper::isAuthenticatedUserSolicitudesOwner($solicitudeId)) {
            return redirect()->route('home_view');
        } else {
            $solicitudeDeliverable = SolicitudeHelper::isSolicitudeCompletelyAnswered($solicitude);
        }

        return view('solicitude_view', [
            'solicitude' => json_decode((new SolicitudeCompleteResource($solicitude))->toJson(), true),
            'solicitudeOwner' => $solicitudeOwner,
            'adminView' => $adminView,
            'solicitudeDeliverable' => $solicitudeDeliverable
        ]);

    })->name('solicitude_view');

});

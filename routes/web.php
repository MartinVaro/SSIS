<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonacionController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\ComentarioController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/details', function () {
    return view('details');
});


Route::get('/', [ProyectoController::class, 'home']);


//Route::get('/', [ProyectoController::class, 'home'])->name('index'); asi la tenia antes

Route::get('/search', [ProyectoController::class, 'search'])->name('searchindex');
Route::get('/categoria/ambiente', [ProyectoController::class, 'search_ambiente'])->name('trindex');
Route::get('/categoria/universo', [ProyectoController::class, 'search_universo'])->name('trindex');
Route::get('/categoria/educacion', [ProyectoController::class, 'search_educacion'])->name('trindex');
Route::get('/categoria/sustentable', [ProyectoController::class, 'search_sustentable'])->name('trindex');
Route::get('/categoria/tecnologico', [ProyectoController::class, 'search_tecnologico'])->name('trindex');
Route::get('/categoria/energia', [ProyectoController::class, 'search_energia'])->name('trindex');
Route::get('/categoria/salud', [ProyectoController::class, 'search_salud'])->name('trindex');
Route::get('/categoria/sociedad', [ProyectoController::class, 'search_sociedad'])->name('trindex');


Route::get('/profile', function(){
    return view('profile');

})->middleware('verified');


Route::resource('proyecto', ProyectoController::class);
//Route::get('/all', [ProyectoController::class, 'all']);

Route::resource('comentario', ComentarioController::class);
//Route::get('/all', [ComentarioController::class, 'all']);

Route::resource('donacion', DonacionController::class);
//Route::get('/all', [DonacionController::class, 'all']);

Route::resource('calificacion', CalificacionController::class);
//Route::get('/all', [CalificacionController::class, 'all']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/admin', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/moderador', [ProyectoController::class, 'home'])->name('allproyect');
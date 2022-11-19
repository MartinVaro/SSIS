<?php

use Illuminate\Support\Facades\Route;
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

//Route::get('/', function () {
//    return view('index');
//});


Route::get('/', [ProyectoController::class, 'home'])->name('index');

//Route::get('/', function () {
//    return view('copi');
//});

Route::get('/details', function(){
    return view('details');
});

Route::get('/profile', function(){
    return view('profile');

})->middleware('verified');


Route::resource('proyecto', ProyectoController::class);
Route::get('/all', [ProyectoController::class, 'all']);


Route::resource('comentario', ComentarioController::class);
Route::get('/all', [ComentarioController::class, 'all']);


Route::resource('calificacion', CalificacionController::class);
Route::get('/all', [CalificacionController::class, 'all']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

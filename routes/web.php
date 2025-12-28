<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\ApotikController;
use App\Http\Controllers\KlinikController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\KimiaFarmaController;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

// FORM LOGIN
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/');
    }
    return view('auth.login');
})->name('login');

// PROSES LOGIN
Route::post('/login', function () {
    $credentials = request()->only('email', 'password');

    if (Auth::attempt($credentials)) {
        request()->session()->regenerate();
        return redirect('/');
    }

    return back()->with('error', 'Email atau password salah');
});

// LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| HALAMAN WAJIB LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // HOME / MAP
    Route::get('/', function () {
        return view('map');
    });

    /*
    |--------------------------------------------------------------------------
    | PUSKESMAS
    |--------------------------------------------------------------------------
    */
    Route::prefix('puskesmas')->group(function () {
        Route::get('/', [PuskesmasController::class, 'index']);
        Route::get('/create', [PuskesmasController::class, 'create']);
        Route::post('/', [PuskesmasController::class, 'store']);
        Route::get('/json', [PuskesmasController::class, 'json']);
        Route::get('/{id}', [PuskesmasController::class, 'show']);
        Route::delete('/{id}', [PuskesmasController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | APOTIK
    |--------------------------------------------------------------------------
    */
    Route::prefix('apotik')->group(function () {
        Route::get('/', [ApotikController::class, 'index']);
        Route::get('/create', [ApotikController::class, 'create']);
        Route::post('/', [ApotikController::class, 'store']);
        Route::get('/json', [ApotikController::class, 'json']);
        Route::get('/{id}', [ApotikController::class, 'show']);
        Route::delete('/{id}', [ApotikController::class, 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | KLINIK
    |--------------------------------------------------------------------------
    */
   Route::prefix('klinik')->group(function () {
    Route::get('/', [KlinikController::class, 'index']);
    Route::get('/create', [KlinikController::class, 'create']);
    Route::post('/', [KlinikController::class, 'store']);
    Route::get('/json', [KlinikController::class, 'json']);
    Route::get('/{id}', [KlinikController::class, 'show']);
    Route::delete('/{id}', [KlinikController::class, 'destroy']);
});


    /*
    |--------------------------------------------------------------------------
    | POSYANDU
    |--------------------------------------------------------------------------
    */
    Route::prefix('posyandu')->group(function () {
    Route::get('/', [PosyanduController::class, 'index']);
    Route::get('/create', [PosyanduController::class, 'create']);
    Route::post('/', [PosyanduController::class, 'store']);
    Route::get('/json', [PosyanduController::class, 'json']);
    Route::get('/{id}', [PosyanduController::class, 'show']);
    Route::delete('/{id}', [PosyanduController::class, 'destroy']);
});

    /*
    |--------------------------------------------------------------------------
    | KIMIA FARMA
    |--------------------------------------------------------------------------
    */
    Route::prefix('kimia-farma')->group(function () {
        Route::get('/', [KimiaFarmaController::class, 'index']);
        Route::get('/create', [KimiaFarmaController::class, 'create']);
        Route::post('/', [KimiaFarmaController::class, 'store']);
        Route::get('/json', [KimiaFarmaController::class, 'json']);
        Route::get('/{id}', [KimiaFarmaController::class, 'show']);
        Route::delete('/{id}', [KimiaFarmaController::class, 'destroy']);
    });

});

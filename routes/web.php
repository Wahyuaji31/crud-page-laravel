<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SessionController;
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


Route::resource('Mahasiswa', MahasiswaController::class);

Route::get('/Sesi', [SessionController::class, 'index']);
Route::post('/Sesi/login', [SessionController::class, 'login']);
Route::get('/Sesi/logout', [SessionController::class, 'logout']);
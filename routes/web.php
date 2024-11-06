<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;

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

Route::get('/login', function () { return view('login'); });

Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

Route::get('/be-home',function() {
    return view('home');
})->name('be.home');

Route::get('/be-um',[UserController::class, 'index'])->name('be.um');

Route::post('/be-um-add',[UserController::class, 'addUserSave'])->name('be.um.add');

/* MAGANG */

Route::get('mg-home', [AbsensiController::class, 'index'])->name('mg.home');

Route::post('mg-absen-save', [AbsensiController::class, 'saveAbsensi'])->name('mg.absen.save');

Route::get('mg-absen-history', [AbsensiController::class, 'history'])->name('mg.absen.history');

Route::get('/mg-recap/{start}/{end}', [AbsensiController::class, 'recap'])->name('mg.recap');

Route::post('mg-recap-m', [AbsensiController::class, 'recapMonthly'])->name('mg.recap.m');

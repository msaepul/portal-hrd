<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\LokerController;

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

Route::get('/', [LokerController::class, 'index'])->name('index');

//auth
Route::get('/register', [AuthController::class, 'showregisterform'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);




Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//masterdata departemen
Route::get('/Masterdata/departemen', [MasterDataController::class, 'showListDept'])->name('masterdata.dept');
Route::post('/Masterdata/departemen', [MasterDataController::class, 'deptStore'])->name('masterdata.dept.action');
//masterdata Cabang
Route::get('/Masterdata/cabang', [MasterDataController::class, 'showListCabang'])->name('masterdata.cabang');
Route::post('/Masterdata/cabang', [MasterDataController::class, 'cabStore'])->name('masterdata.cabang.action');

//Loker
Route::get('/loker', [LokerController::class, 'showListloker'])->name('loker');
Route::get('/detail_loker', [LokerController::class, 'lokerdetail'])->name('loker_detail');
Route::get('/loker/add', [LokerController::class, 'addLoker'])->name('addloker');
Route::post('/loker/store', [LokerController::class, 'addLokerstore'])->name('addloker.store');

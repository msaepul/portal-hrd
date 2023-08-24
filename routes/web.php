<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\Notif;

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
Route::get('/lokers/{id}', [LokerController::class, 'detailLandingLoker'])->name('landingloker');
Route::get('/lokers/{id}/apply', [LokerController::class, 'applyLandingLoker'])->name('applyloker');
Route::post('getkota', [LokerController::class, 'getkota'])->name('getkota');
Route::post('getkecamatan', [LokerController::class, 'getkecamatan'])->name('getkecamatan');


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
//masterdata skill
Route::get('/Masterdata/skill', [MasterDataController::class, 'showListskill'])->name('masterdata.skill');
Route::post('/Masterdata/skill', [MasterDataController::class, 'skillStore'])->name('masterdata.skill.action');

Route::get('/Masterdata/skill/updateStatus/{id}', [MasterDataController::class, 'updateStatus'])->defaults('model', 'Skills')->name('skills.updateStatus');
Route::get('/Masterdata/Cabang/updateStatus/{id}', [MasterDataController::class, 'updateStatus'])->defaults('model', 'Cabang')->name('Cabang.updateStatus');
Route::get('/Masterdata/Departemen/updateStatus/{id}', [MasterDataController::class, 'updateStatus'])->defaults('model', 'Departemen')->name('Departemen.updateStatus');

//Loker
Route::get('/loker', [LokerController::class, 'showListloker'])->name('loker');
Route::get('/detail_loker', [LokerController::class, 'lokerdetail'])->name('loker_detail');
Route::get('/loker/add', [LokerController::class, 'addLoker'])->name('addloker');
Route::post('/loker/store', [LokerController::class, 'addLokerstore'])->name('addloker.store');
Route::delete('/loker/delete/{id}', [LokerController::class, 'deleteLoker'])->name('loker.delete');
Route::get('/loker/updates/{id}', [LokerController::class, 'updatestatus'])->name('loker.update');
Route::get('/loker/edit/{id}', [LokerController::class, 'showEditloker'])->name('loker.edit');
Route::put('/loker/update/{id}', [LokerController::class, 'editLokerstore'])->name('loker.edit.action');



Route::get('/notif', [Notif::class, 'sendWhatsApp'])->name('addloker.store');

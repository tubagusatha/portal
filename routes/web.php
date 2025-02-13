<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BgfrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfographisController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\UcapanController;
use App\Http\Middleware\IsAdmin;
use App\Models\Infographis;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/portal', [HomeController::class, 'portal'])->name('portal');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register/form', [AuthController::class, 'registerform'])->name('registerform');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('auth');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware([IsAdmin::class])->group(function () {

    Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/infographis', [InfographisController::class, 'index'])->name('infographis.index');
    Route::get('/admin/infographis/create', [InfographisController::class, 'create'])->name('infographis.create');
    Route::post('admin/infographis/store', [InfographisController::class, 'store'])->name('infographis.store');


    Route::get('admin/infographis/{id}/edit', [InfographisController::class, 'edit'])->name('infographis.edit');
    Route::patch('admin/infographis/update/{infographis}', [InfographisController::class, 'update'])->name('infographis.update');
    Route::delete('admin/infographis/{id}/destroy', [InfographisController::class, 'destroy'])->name('infographis.destroy');


    Route::get('/admin/portal', [PortalController::class, 'index'])->name('portal.index');
    Route::get('/admin/portal/create', [PortalController::class, 'create'])->name('portal.create');
    Route::post('admin/portal/store', [PortalController::class, 'store'])->name('portal.store');
    Route::get('admin/portal/{id}/edit', [PortalController::class, 'edit'])->name('portal.edit');
    Route::patch('admin/portal/update/{portal}', [PortalController::class, 'update'])->name('portal.update');
    Route::delete('admin/portal/{id}/destroy', [PortalController::class, 'destroy'])->name('portal.destroy');


    Route::get('/admin/bg', [BgfrontController::class, 'index'])->name('bg.index');
    Route::get('/admin/bg/create', [BgfrontController::class, 'create'])->name('bg.create');
    Route::post('admin/bg/store', [BgfrontController::class, 'store'])->name('bg.store');
    Route::get('admin/bg/{id}/edit', [BgfrontController::class, 'edit'])->name('bg.edit');
    Route::patch('admin/bg/update/{bg}', [BgfrontController::class, 'update'])->name('bg.update');
    Route::delete('admin/bg/{id}/destroy', [BgfrontController::class, 'destroy'])->name('bg.destroy');



    Route::get('/admin/ucapan', [UcapanController::class, 'index'])->name('ucapan.index');
    Route::get('/admin/ucapan/create', [UcapanController::class, 'create'])->name('ucapan.create');
    Route::post('admin/ucapan/store', [UcapanController::class, 'store'])->name('ucapan.store');
    Route::get('admin/ucapan/{id}/edit', [UcapanController::class, 'edit'])->name('ucapan.edit');
    Route::patch('admin/ucapan/update/{ucapan}', [UcapanController::class, 'update'])->name('ucapan.update');
    Route::delete('admin/ucapan/{id}/destroy', [UcapanController::class, 'destroy'])->name('ucapan.destroy');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\WeightLogController;
use App\Http\Controllers\WeightTargetController;


Route::middleware('auth')->group(function () {
    Route::get('/weight_logs', [WeightController::class, 'index'])->name('weight.index');
    
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])->name('weight_logs.create');
    Route::post('/weight_logs', [WeightLogController::class, 'store'])->name('weight_logs.store');
    
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])->name('weight_logs.search');

    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show'])->name('weight_logs.show');
    Route::get('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'edit'])->name('weight_logs.edit');
    Route::put('/weight_logs/{weightLogId}', [WeightLogController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{weightLogId}', [WeightLogController::class, 'destroy'])->name('weight_logs.destroy');

    Route::get('/weight_logs/goal_setting', [WeightTargetController::class, 'edit'])->name('weight_target.edit');
    Route::put('/weight_logs/goal_setting', [WeightTargetController::class, 'update'])->name('weight_target.update');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/', [WeightController::class, 'weight']);
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register/step1', [RegisterController::class, 'showStep1Form'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'processStep1']);

Route::get('/register/step2', [RegisterController::class, 'showStep2Form'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'processStep2']);
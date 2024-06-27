<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/', [Controllers\AuthController::class, 'process'])->name('login.process');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('app')->group(function () {
        /* Dashboard */
        Route::get('dashboard', [Controllers\DashboardController::class, 'index'])->name('dashboard');

        /* Alternatif */
        Route::resource('alternatives', Controllers\AlternativeController::class)->except('show');

        /* Kriteria */
        Route::resource('criterias', Controllers\CriteriaController::class)->except('show');

        /* Perhitungan */
        Route::get('perhitungan', [Controllers\CalculationController::class, 'index'])->name('perhitungan.index');
        Route::get('perhitungan/create', [Controllers\CalculationController::class, 'create'])->name('perhitungan.create');
        Route::post('perhitungan', [Controllers\CalculationController::class, 'store'])->name('perhitungan.store');
        Route::get('perhitungan/{id}/edit', [Controllers\CalculationController::class, 'edit'])->name('perhitungan.edit');
        Route::put('perhitungan/{id}', [Controllers\CalculationController::class, 'update'])->name('perhitungan.update');
        Route::delete('perhitungan/{id}', [Controllers\CalculationController::class, 'destroy'])->name('perhitungan.destroy');

        /* Hasil */
        Route::get('hasil', [Controllers\HasilController::class, 'index'])->name('hasil.index');

        /* Logout */
        Route::post('logout', [Controllers\AuthController::class, 'logout'])->name('logout');
    });
});

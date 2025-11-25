<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZakatController;

Route::redirect('/', '/zakat');

Route::get('/zakat', [ZakatController::class, 'index'])->name('zakat.index');
Route::get('/zakat/create', [ZakatController::class, 'create'])->name('zakat.create');
Route::post('/zakat', [ZakatController::class, 'store'])->name('zakat.store');
Route::get('/zakat/{id}', [ZakatController::class, 'show'])->name('zakat.show');
Route::get('/zakat/{id}/edit', [ZakatController::class, 'edit'])->name('zakat.edit');
Route::put('/zakat/{id}', [ZakatController::class, 'update'])->name('zakat.update');
Route::delete('/zakat/{id}', [ZakatController::class, 'destroy'])->name('zakat.destroy');
Route::post('/zakat/calculate', [ZakatController::class, 'calculate'])->name('zakat.calculate');

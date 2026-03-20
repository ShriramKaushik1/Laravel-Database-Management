<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\DeduplicationController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('import.index');
});

// Import Routes
Route::get('/import', [ImportController::class, 'index'])->name('import.index');
Route::post('/import', [ImportController::class, 'store'])->name('import.store');

// Deduplication Routes
Route::get('/deduplicate', [DeduplicationController::class, 'index'])->name('deduplicate.index');
Route::post('/deduplicate/{id}/merge', [DeduplicationController::class, 'merge'])->name('deduplicate.merge');

// Report Routes
Route::get('/report', [ReportController::class, 'index'])->name('report.index');

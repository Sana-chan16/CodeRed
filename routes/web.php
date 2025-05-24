<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CaseReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/case-management', [App\Http\Controllers\CaseReportController::class, 'index'])->name('caseManagement');

Route::get('/submit-case', function () {
    return view('user.submateCase');
})->name('submateCase');

Route::post('/case-reports', [CaseReportController::class, 'store'])->name('caseReports.store');

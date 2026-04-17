<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SadqaController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index']);

/* Sadqa */
Route::get('/sadqa/create', [SadqaController::class, 'create']);
Route::post('/sadqa/store', [SadqaController::class, 'store']);

/* Entry */
Route::get('/entry/create', [EntryController::class, 'create']);
Route::post('/entry/store', [EntryController::class, 'store']);
Route::get('/entry', [EntryController::class, 'index']);

/* Salary */
Route::get('/salary/create', [SalaryController::class, 'create']);
Route::post('/salary/store', [SalaryController::class, 'store']);
Route::get('/salary', [SalaryController::class, 'index']);

/* Dashboard */
Route::get('/dashboard', [DashboardController::class, 'index']);
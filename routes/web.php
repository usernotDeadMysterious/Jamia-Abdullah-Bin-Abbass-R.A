<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SadqaController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sadqa/create', [SadqaController::class, 'create']);
    Route::post('/sadqa/store', [SadqaController::class, 'store']);

    Route::get('/entry/create', [EntryController::class, 'create']);
    Route::post('/entry/store', [EntryController::class, 'store']);
    Route::get('/entry', [EntryController::class, 'index']);

    Route::get('/salary/create', [SalaryController::class, 'create']);
    Route::post('/salary/store', [SalaryController::class, 'store']);
    Route::get('/salary', [SalaryController::class, 'index']);




    Route::get('/expense/create', [ExpenseController::class, 'create']);
    Route::post('/expense/store', [ExpenseController::class, 'store']);
    Route::get('/expense', [ExpenseController::class, 'index']);

    Route::resource('students', StudentController::class);

});

require __DIR__ . '/auth.php';
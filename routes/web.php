<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SadqaController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Barryvdh\DomPDF\Facade\Pdf;

use ArPHP\I18N\Arabic;
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





    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');

    Route::resource('students', StudentController::class);

    Route::middleware(['auth'])->group(function () {
        Route::resource('teachers', TeacherController::class);
    });

    Route::get('/reports/income', [EntryController::class, 'report'])->name('reports.income');
    Route::get('/reports/income/pdf', [EntryController::class, 'reportPdf'])
        ->name('reports.income.pdf');

    Route::get('/reports/expense', [ExpenseController::class, 'report']);
    Route::get('/reports/expense/pdf', [ExpenseController::class, 'reportPdf'])
        ->name('reports.expense.pdf');


    Route::get('/reports/income/pdf-browser', [EntryController::class, 'reportPdfBrowser']);

    Route::get('/reports/expense', [ExpenseController::class, 'report'])
        ->name('reports.expense');

    Route::get('/reports/expense/pdf-browser', [ExpenseController::class, 'reportPdfBrowser']);

    Route::get('/salary-report', [ExpenseController::class, 'salaries'])
        ->name('salary.report');

    Route::get('/reports/salary/pdf-browser', [ExpenseController::class, 'salaryPdfBrowser']);

    Route::get('/students/{id}/id-card', [StudentController::class, 'idCard'])
        ->name('students.idcard');

    // test pdf
    Route::get('/test-pdf', function () {

        $arabic = new Arabic();

        $title = $arabic->utf8Glyphs('اردو ٹیسٹ');
        $text = $arabic->utf8Glyphs('یہ ایک ٹیسٹ ہے کہ اردو صحیح دکھ رہی ہے یا نہیں۔');

        $pdf = Pdf::loadView('test-pdf', [
            'title' => $title,
            'text' => $text,
        ])->setOptions([
                    'defaultFont' => 'urdu',
                    'isRemoteEnabled' => true,
                    'chroot' => public_path(),
                ]);

        return $pdf->stream();
    });
});

Route::get('/verify/student/{id}', [StudentController::class, 'verify'])
    ->name('students.verify');



require __DIR__ . '/auth.php';
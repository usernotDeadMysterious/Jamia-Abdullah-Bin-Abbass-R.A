<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Sadqa;
use App\Models\Salary;

class DashboardController extends Controller
{
    public function index()
    {
        // Entry-based totals
        $totalIncome = Entry::whereIn('type', ['صدقہ', 'زکوٰۃ'])->sum('amount');
        $totalExpense = Entry::where('type', 'خرچ')->sum('amount');

        // Sadqa (separate module)
        $totalSadqa = Sadqa::sum('amount');

        // Salary totals
        $totalSalary = Salary::sum('total');

        // Final balance
        $balance = ($totalIncome + $totalSadqa) - ($totalExpense + $totalSalary);

        return view('dashboard.index', compact(
            'totalIncome',
            'totalExpense',
            'totalSadqa',
            'totalSalary',
            'balance'
        ));
    }
}
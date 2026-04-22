<?php

namespace App\Http\Controllers;

use App\Models\Entry;

use Carbon\Carbon;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        // 📅 TIME RANGES
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $yearStart = Carbon::now()->startOfYear();

        // 💰 INCOME
        $incomeToday = Entry::whereDate('date', $today)->sum('amount');
        $incomeWeek = Entry::whereBetween('date', [$weekStart, now()])->sum('amount');
        $incomeMonth = Entry::whereBetween('date', [$monthStart, now()])->sum('amount');
        $incomeYear = Entry::whereBetween('date', [$yearStart, now()])->sum('amount');

        // 💸 EXPENSE
        $expenseToday = Expense::whereDate('date', $today)->sum('amount');
        $expenseWeek = Expense::whereBetween('date', [$weekStart, now()])->sum('amount');
        $expenseMonth = Expense::whereBetween('date', [$monthStart, now()])->sum('amount');
        $expenseYear = Expense::whereBetween('date', [$yearStart, now()])->sum('amount');

        // 🧾 SALARY (ONLY MONTH)
        $salaryMonth = Expense::where('category', 'تنخواہ')
            ->whereBetween('date', [$monthStart, now()])
            ->sum('amount');

        // 📊 BALANCE (MONTH BASED = BEST PRACTICE)
        $balance = $incomeMonth - $expenseMonth;

        // 📈 TREND (LAST 7 DAYS)
        $trend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);

            $trend[] = [
                'date' => $date->format('d M'),
                'income' => Entry::whereDate('date', $date)->sum('amount'),
                'expense' => Expense::whereDate('date', $date)->sum('amount'),
            ];
        }
        // 📈 LAST 30 DAYS TREND
        $monthlyTrend = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);

            $monthlyTrend[] = [
                'date' => $date->format('d M'),
                'income' => Entry::whereDate('date', $date)->sum('amount'),
                'expense' => Expense::whereDate('date', $date)->sum('amount'),
            ];
        }

        return view('dashboard.index', compact(
            'incomeToday',
            'incomeWeek',
            'incomeMonth',
            'incomeYear',

            'expenseToday',
            'expenseWeek',
            'expenseMonth',
            'expenseYear',

            'salaryMonth',
            'balance',
            'trend',
            'monthlyTrend'
        ));
    }
}
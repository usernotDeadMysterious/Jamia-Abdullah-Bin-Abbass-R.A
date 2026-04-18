<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // 🔹 Show form
    public function create()
    {
        return view('expense.create');
    }

    // 🔹 Store expense
    public function store(Request $request)
    {
        $expense = new Expense();

        $expense->date = $request->date;
        $expense->title = $request->title;
        $expense->given_to = $request->given_to;
        $expense->category = $request->category;
        $expense->amount = $request->amount;
        $expense->description = $request->description;

        $expense->save();

        return back()->with('success', 'خرچ محفوظ ہوگیا');
    }

    // 🔹 List / Report
    public function index(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $query = Expense::query();

        if ($month && $year) {
            $query->whereMonth('date', $month)
                ->whereYear('date', $year);
        }

        $expenses = $query->orderBy('date', 'desc')->get();

        $totalExpense = $query->sum('amount');

        return view('expense.index', compact('expenses', 'totalExpense', 'month', 'year'));
    }
}
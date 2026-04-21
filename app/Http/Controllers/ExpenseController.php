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
        $search = $request->search;

        $query = Expense::query();

        // 📅 Month + Year filter
        if ($month && $year) {
            $query->whereMonth('date', $month)
                ->whereYear('date', $year);
        }

        // 🔍 Search filter (POWERFUL)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('given_to', 'like', "%$search%")
                    ->orWhere('category', 'like', "%$search%");
            });
        }

        // 📊 Pagination (10 per page)
        $expenses = $query->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString(); // keep filters in pagination

        $totalExpense = $query->sum('amount');

        return view('expense.index', compact(
            'expenses',
            'totalExpense',
            'month',
            'year',
            'search'
        ));
    }
}
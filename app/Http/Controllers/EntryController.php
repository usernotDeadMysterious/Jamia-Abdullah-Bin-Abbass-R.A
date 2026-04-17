<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function create()
    {
        return view('entry.create');
    }

    public function store(Request $request)
    {
        $entry = new Entry();

        $entry->date = $request->date;
        $entry->name = $request->name;
        $entry->receipt_no = $request->receipt_no;
        $entry->amount = $request->amount;
        $entry->type = $request->type;
        $entry->description = $request->description;

        $entry->save();

        return back()->with('success', 'اندراج محفوظ ہوگیا');
    }

    public function index(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $query = Entry::query();

        if ($month && $year) {
            $query->whereMonth('date', $month)
                  ->whereYear('date', $year);
        }

        $entries = $query->orderBy('date', 'desc')->get();

        $totalIncome = $query->whereIn('type', ['صدقہ', 'زکوٰۃ'])->sum('amount');
        $totalExpense = Entry::where('type', 'خرچ')
            ->when($month && $year, function ($q) use ($month, $year) {
                $q->whereMonth('date', $month)
                  ->whereYear('date', $year);
            })
            ->sum('amount');

        return view('entry.index', compact('entries', 'totalIncome', 'totalExpense', 'month', 'year'));
    }
}
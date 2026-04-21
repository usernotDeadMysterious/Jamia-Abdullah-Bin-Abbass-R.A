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
        $search = $request->search;

        $query = Entry::query();

        // 📅 Month + Year filter
        if ($month && $year) {
            $query->whereMonth('date', $month)
                ->whereYear('date', $year);
        }

        // 🔍 Search (POWERFUL)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('receipt_no', 'like', "%$search%")
                    ->orWhere('type', 'like', "%$search%");
            });
        }

        // 📄 Pagination
        $entries = $query->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        // 💰 Totals (separate queries = correct data)
        $totalIncome = Entry::when($month && $year, function ($q) use ($month, $year) {
            $q->whereMonth('date', $month)
                ->whereYear('date', $year);
        })
            ->whereIn('type', ['صدقہ', 'زکوٰۃ'])
            ->sum('amount');

        $totalExpense = Entry::when($month && $year, function ($q) use ($month, $year) {
            $q->whereMonth('date', $month)
                ->whereYear('date', $year);
        })
            ->where('type', 'خرچ')
            ->sum('amount');

        return view('entry.index', compact(
            'entries',
            'totalIncome',
            'totalExpense',
            'month',
            'year',
            'search'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function create()
    {
        return view('salary.create');
    }

    public function store(Request $request)
    {
        $salary = new Salary();

        $salary->name = $request->name;
        $salary->designation = $request->designation;

        $salary->days = $request->days;
        $salary->rate = $request->rate;

        $amount = $request->days * $request->rate;

        $salary->amount = $amount;
        $salary->allowance = $request->allowance ?? 0;

        $total = $amount + $salary->allowance;

        $salary->total = $total;
        $salary->advance = $request->advance ?? 0;
        $salary->remaining = $total - $salary->advance;

        $salary->month = $request->month;
        $salary->year = $request->year;

        $salary->save();

        return back()->with('success', 'تنخواہ محفوظ ہوگئی');
    }

    public function index()
    {
        $salaries = Salary::orderBy('id')->get();

        return view('salary.index', compact('salaries'));
    }
}
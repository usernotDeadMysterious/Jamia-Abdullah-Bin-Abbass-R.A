<?php

namespace App\Http\Controllers;

use App\Models\Sadqa;
use Illuminate\Http\Request;

class SadqaController extends Controller
{
    public function create()
    {
        return view('sadqa.create');
    }

    public function store(Request $request)
    {
        $sadqa = new Sadqa();

        $sadqa->type = $request->type;
        $sadqa->amount = $request->amount;
        $sadqa->donor = $request->donor;
        $sadqa->date = $request->date;

        $sadqa->save();

        return back()->with('success', 'اندراج محفوظ ہوگیا');
    }
}
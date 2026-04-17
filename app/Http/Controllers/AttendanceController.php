<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function create()
    {
        return view('attendance.create');
    }

    public function store(Request $request)
    {
        foreach ($request->days as $day => $status) {

            $attendance = new Attendance();

            $attendance->student_name = $request->student_name;
            $attendance->class = $request->class;
            $attendance->date = now()->startOfMonth()->addDays($day - 1);
            $attendance->present = $status;

            $attendance->save();
        }

        return back()->with('success', 'حاضری محفوظ ہوگئی');
    }
}
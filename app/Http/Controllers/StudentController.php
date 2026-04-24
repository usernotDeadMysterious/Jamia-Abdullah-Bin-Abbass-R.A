<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Spatie\Browsershot\Browsershot;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $class = $request->class_level;
        $status = $request->status;

        $query = Student::query();

        // 🔍 Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('father_name', 'like', "%$search%")
                    ->orWhere('registration_no', 'like', "%$search%");
            });
        }

        // 🎓 Class Filter
        if ($class) {
            $query->where('class_level', $class);
        }

        // 📊 Status Filter
        if ($status) {
            $query->where('status', $status);
        }

        // 📄 Pagination
        $students = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('students.index', compact(
            'students',
            'search',
            'class',
            'status'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
        //
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Create student
        $student = Student::create($request->all());

        // 📸 Student Image
        if ($request->hasFile('student_image')) {
            $path = $request->file('student_image')->store('students', 'public');

            $student->documents()->create([
                'type' => 'image',
                'file_path' => $path
            ]);
        }

        // 🪪 CNIC Document
        if ($request->hasFile('cnic_document')) {
            $path = $request->file('cnic_document')->store('students', 'public');

            $student->documents()->create([
                'type' => 'cnic',
                'file_path' => $path
            ]);
        }

        // 📁 Extra Documents
        if ($request->hasFile('extra_documents')) {
            foreach ($request->file('extra_documents') as $file) {
                $path = $file->store('students', 'public');

                $student->documents()->create([
                    'type' => 'other',
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('students.index')
            ->with('success', 'طالب علم کامیابی سے شامل ہو گیا');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::with('documents')->findOrFail($id);

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::with('documents')->findOrFail($id);

        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        // Update basic data
        $student->update($request->all());

        // Replace Image
        if ($request->hasFile('student_image')) {
            $path = $request->file('student_image')->store('students', 'public');

            $student->documents()->where('type', 'image')->delete();

            $student->documents()->create([
                'type' => 'image',
                'file_path' => $path
            ]);
        }

        // Replace CNIC
        if ($request->hasFile('cnic_document')) {
            $path = $request->file('cnic_document')->store('students', 'public');

            $student->documents()->where('type', 'cnic')->delete();

            $student->documents()->create([
                'type' => 'cnic',
                'file_path' => $path
            ]);
        }

        // Add extra docs
        if ($request->hasFile('extra_documents')) {
            foreach ($request->file('extra_documents') as $file) {
                $path = $file->store('students', 'public');

                $student->documents()->create([
                    'type' => 'other',
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('students.show', $student->id)
            ->with('success', 'ریکارڈ کامیابی سے اپڈیٹ ہو گیا');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy($id)
    {
        $student = Student::with('documents')->findOrFail($id);

        // 🔥 Delete files from storage
        foreach ($student->documents as $doc) {
            if (Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }
        }

        // 🔥 Delete student (documents auto-delete via cascade)
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'طالب علم کامیابی سے حذف کر دیا گیا');
    }



    public function idCard($id)
    {
        $student = Student::with('documents')->findOrFail($id);

        $html = view('students.id-card', compact('student'))->render();

        return response(
            Browsershot::html($html)
                ->windowSize(600, 350) // ID card size
                ->showBackground()
                ->pdf()
        )->header('Content-Type', 'application/pdf');
    }

    public function verify($id)
    {
        try {
            $id = decrypt($id);
        } catch (\Exception $e) {
            return "Invalid QR Code";
        }

        $student = \App\Models\Student::find($id);

        if (!$student) {
            return "Student not found";
        }

        return view('students.verify', compact('student'));
    }
}

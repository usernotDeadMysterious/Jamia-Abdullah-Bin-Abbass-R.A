<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
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
        // 1. Create student
        $student = Student::create($request->all());

        // 2. Student Image
        if ($request->hasFile('student_image')) {
            $path = $request->file('student_image')->store('students', 'public');

            $student->documents()->create([
                'type' => 'image',
                'file_path' => $path
            ]);
        }

        // 3. CNIC Document
        if ($request->hasFile('cnic_document')) {
            $path = $request->file('cnic_document')->store('students', 'public');

            $student->documents()->create([
                'type' => 'cnic',
                'file_path' => $path
            ]);
        }

        // 4. Extra Documents
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
}

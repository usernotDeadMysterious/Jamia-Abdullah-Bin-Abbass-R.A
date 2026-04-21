<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use App\Models\Document;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $status = $request->status;

        $query = \App\Models\Teacher::query();

        // 🔍 Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%$search%")
                    ->orWhere('cnic', 'like', "%$search%")
                    ->orWhere('contact', 'like', "%$search%")
                    ->orWhere('subjects', 'like', "%$search%");
            });
        }

        // 📊 Status Filter
        if ($status) {
            $query->where('status', $status);
        }

        // 📄 Pagination
        $teachers = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('teachers.index', compact(
            'teachers',
            'search',
            'status'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }
    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $teacher = \App\Models\Teacher::create($request->all());

        // Image
        if ($request->hasFile('teacher_image')) {
            $path = $request->file('teacher_image')->store('teachers', 'public');

            $teacher->documents()->create([
                'type' => 'image',
                'file_path' => $path
            ]);
        }

        // CNIC
        if ($request->hasFile('cnic_document')) {
            $path = $request->file('cnic_document')->store('teachers', 'public');

            $teacher->documents()->create([
                'type' => 'cnic',
                'file_path' => $path
            ]);
        }

        // Extra
        if ($request->hasFile('extra_documents')) {
            foreach ($request->file('extra_documents') as $file) {
                $path = $file->store('teachers', 'public');

                $teacher->documents()->create([
                    'type' => 'other',
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('teachers.index')
            ->with('success', 'استاد کامیابی سے شامل ہو گیا');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $teacher = \App\Models\Teacher::findOrFail($id);

        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = \App\Models\Teacher::findOrFail($id);

        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        $teacher = \App\Models\Teacher::findOrFail($id);

        $teacher->update($request->all());

        // 🔥 Replace Image
        if ($request->hasFile('teacher_image')) {

            $oldImage = $teacher->documents()->where('type', 'image')->first();

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage->file_path);
                $oldImage->delete();
            }

            $path = $request->file('teacher_image')->store('teachers', 'public');

            $teacher->documents()->create([
                'type' => 'image',
                'file_path' => $path
            ]);
        }

        // 🔥 Replace CNIC
        if ($request->hasFile('cnic_document')) {

            $oldCnic = $teacher->documents()->where('type', 'cnic')->first();

            if ($oldCnic) {
                Storage::disk('public')->delete($oldCnic->file_path);
                $oldCnic->delete();
            }

            $path = $request->file('cnic_document')->store('teachers', 'public');

            $teacher->documents()->create([
                'type' => 'cnic',
                'file_path' => $path
            ]);
        }

        // 🔥 Add extra documents
        if ($request->hasFile('extra_documents')) {
            foreach ($request->file('extra_documents') as $file) {

                $path = $file->store('teachers', 'public');

                $teacher->documents()->create([
                    'type' => 'other',
                    'file_path' => $path
                ]);
            }
        }

        return redirect()->route('teachers.show', $teacher->id)
            ->with('success', 'استاد کا ریکارڈ اپڈیٹ ہو گیا');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = \App\Models\Teacher::with('documents')->findOrFail($id);

        foreach ($teacher->documents as $doc) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', 'استاد کامیابی سے حذف کر دیا گیا');
    }
}

<x-app-layout>
    <div dir="rtl">
        <h2 class="text-xl font-bold mb-4">طلبہ کی فہرست</h2>

        {{-- Search and Filter --}}
        <form method="GET" class="row g-2 mb-4 align-items-end">

            {{-- ➕ Add --}}
            <div class="col-md-2">
                <a href="{{ route('students.create') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded w-100 text-center d-block">
                    + نیا طالب علم
                </a>
            </div>

            {{-- 🔍 Search --}}
            <div class="col-md-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="نام / والد / رجسٹریشن نمبر">
            </div>

            {{-- 🎓 Class --}}
            <div class="col-md-2">
                <input type="text" name="class_level" value="{{ request('class_level') }}" class="form-control"
                    placeholder="کلاس">
            </div>

            {{-- 📊 Status --}}
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">اسٹیٹس</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- 🔘 Buttons --}}
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary w-100">فلٹر</button>
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary w-100">
                    ری سیٹ
                </a>
            </div>

        </form>

        {{-- record table --}}

        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>والد</th>
                            <th>کلاس</th>
                            <th>اسٹیٹس</th>
                            <th>کارروائیاں</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $students->firstItem() + $loop->index }}</td>
                                <td class="fw-bold">{{ $student->full_name }}</td>
                                <td>{{ $student->father_name }}</td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $student->class_level }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $student->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $student->status }}
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        <a href="{{ route('students.show', $student->id) }}"
                                            class="btn btn-sm btn-primary">دیکھیں</a>

                                        <a href="{{ route('students.edit', $student->id) }}"
                                            class="btn btn-sm btn-warning">ترمیم</a>

                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            onsubmit="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger">حذف</button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">کوئی ریکارڈ موجود نہیں</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        {{-- pagination --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $students->links() }}
        </div>
    </div>
</x-app-layout>
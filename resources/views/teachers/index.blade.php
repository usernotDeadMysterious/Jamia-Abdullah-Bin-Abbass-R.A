<x-app-layout>

    <div class="max-w-6xl mx-auto" dir="rtl">

        <h2 class="text-xl font-bold mb-4">اساتذہ کی فہرست</h2>
        {{-- Search and Filters --}}
        <form method="GET" class="row g-2 mb-4 align-items-end">

            {{-- ➕ Add --}}
            <div class="col-md-2">
                <a href="{{ route('teachers.create') }}"
                    class="bg-green-600 text-white px-3 py-2 rounded w-100 text-center d-block">
                    + نیا استاد
                </a>
            </div>

            {{-- 🔍 Search --}}
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="نام / CNIC / رابطہ / مضمون">
            </div>

            {{-- 📊 Status --}}
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">اسٹیٹس</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Buttons --}}
            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary w-100">فلٹر</button>
                <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary w-100">
                    ری سیٹ
                </a>
            </div>

        </form>
        {{-- Table and record s --}}
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>CNIC</th>
                            <th>رابطہ</th>
                            <th>مضامین</th>
                            <th>تنخواہ</th>
                            <th>اسٹیٹس</th>
                            <th>کارروائیاں</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($teachers as $teacher)
                            <tr>

                                <td>{{ $teachers->firstItem() + $loop->index }}</td>

                                <td class="fw-bold">{{ $teacher->full_name }}</td>
                                <td>{{ $teacher->cnic }}</td>
                                <td>{{ $teacher->contact }}</td>

                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $teacher->subjects }}
                                    </span>
                                </td>

                                <td class="fw-bold text-success">
                                    {{ number_format($teacher->salary) }}
                                </td>

                                <td>
                                    <span class="badge {{ $teacher->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $teacher->status }}
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">

                                        <a href="{{ route('teachers.show', $teacher->id) }}"
                                            class="btn btn-sm btn-primary">دیکھیں</a>

                                        <a href="{{ route('teachers.edit', $teacher->id) }}"
                                            class="btn btn-sm btn-warning">ترمیم</a>

                                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
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
                                <td colspan="8">کوئی ریکارڈ موجود نہیں</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
        {{-- pagination --}}
        <div class="mt-3 d-flex justify-content-center">
            {{ $teachers->links() }}
        </div>
    </div>

</x-app-layout>
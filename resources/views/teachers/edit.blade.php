<x-app-layout>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow" dir="rtl">

        <h2 class="text-2xl font-bold mb-6 text-right">
            استاد میں ترمیم
        </h2>

        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="space-y-4"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Full Name -->
            <div>
                <label class="block mb-1">پورا نام</label>
                <input type="text" name="full_name" value="{{ $teacher->full_name }}" class="w-full border p-2 rounded">
            </div>

            <!-- CNIC -->
            <div>
                <label class="block mb-1">شناختی کارڈ نمبر</label>
                <input type="text" name="cnic" value="{{ $teacher->cnic }}" class="w-full border p-2 rounded">
            </div>

            <!-- Contact -->
            <div>
                <label class="block mb-1">رابطہ نمبر</label>
                <input type="text" name="contact" value="{{ $teacher->contact }}" class="w-full border p-2 rounded">
            </div>

            <!-- Subjects -->
            <div>
                <label class="block mb-1">مضامین</label>
                <input type="text" name="subjects" value="{{ $teacher->subjects }}" class="w-full border p-2 rounded">
            </div>

            <!-- Salary -->
            <div>
                <label class="block mb-1">تنخواہ</label>
                <input type="number" name="salary" value="{{ $teacher->salary }}" class="w-full border p-2 rounded">
            </div>

            <!-- Joining Date -->
            <div>
                <label class="block mb-1">شمولیت کی تاریخ</label>
                <input type="date" name="joining_date" value="{{ $teacher->joining_date }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1">اسٹیٹس</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="active" {{ $teacher->status == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ $teacher->status == 'inactive' ? 'selected' : '' }}>غیر فعال</option>
                </select>
            </div>

            <!-- Teacher Image -->
            @php
                $image = $teacher->documents->where('type', 'image')->first();
            @endphp

            @if($image)
                <img src="{{ asset('storage/' . $image->file_path) }}" class="w-20 h-20 mb-2 rounded object-cover">
            @endif
            <div>
                <label class="block mb-1">نئی تصویر</label>
                <input type="file" name="teacher_image" class="w-full border p-2 rounded">
            </div>

            <!-- CNIC -->
            @php
                $cnic = $teacher->documents->where('type', 'cnic')->first();
            @endphp

            @if($cnic)
                <a href="{{ asset('storage/' . $cnic->file_path) }}" target="_blank" class="text-blue-600 underline">
                    موجودہ CNIC دیکھیں
                </a>
            @endif
            <div>
                <label class="block mb-1">نیا CNIC</label>
                <input type="file" name="cnic_document" class="w-full border p-2 rounded">
            </div>

            <!-- Extra Documents -->
            <div id="extraDocs" class="space-y-2">
                <label class="block mb-1">مزید دستاویزات</label>
            </div>

            <button type="button" onclick="addDocumentField()" class="bg-gray-200 px-3 py-1 rounded">
                + مزید شامل کریں
            </button>

            <!-- Submit -->
            <div class="text-left">
                <button class="bg-blue-600 text-white px-6 py-2 rounded">
                    اپڈیٹ کریں
                </button>
            </div>

        </form>
    </div>
    <script>
        function addDocumentField() {
            let container = document.getElementById('extraDocs');

            let input = document.createElement('input');
            input.type = 'file';
            input.name = 'extra_documents[]';
            input.className = 'w-full border p-2 rounded mt-1';

            container.appendChild(input);
        }
    </script>
</x-app-layout>
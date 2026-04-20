<x-app-layout>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow" dir="rtl">

        <h2 class="text-2xl font-bold mb-6 text-right">
            طالب علم میں ترمیم
        </h2>

        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Registration No -->
            <div>
                <label class="block mb-1">رجسٹریشن نمبر</label>
                <input type="text" value="{{ $student->registration_no }}" readonly
                    class="w-full border p-2 rounded bg-gray-100">
            </div>

            <!-- Full Name -->
            <div>
                <label class="block mb-1">پورا نام</label>
                <input type="text" name="full_name" value="{{ $student->full_name }}" class="w-full border p-2 rounded">
            </div>

            <!-- Father Name -->
            <div>
                <label class="block mb-1">والد کا نام</label>
                <input type="text" name="father_name" value="{{ $student->father_name }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- DOB -->
            <div>
                <label class="block mb-1">تاریخ پیدائش</label>
                <input type="date" name="date_of_birth" value="{{ $student->date_of_birth }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- CNIC -->
            <div>
                <label class="block mb-1">شناختی کارڈ نمبر</label>
                <input type="text" name="cnic" value="{{ $student->cnic }}" class="w-full border p-2 rounded">
            </div>

            <!-- Contact -->
            <div>
                <label class="block mb-1">رابطہ نمبر</label>
                <input type="text" name="contact" value="{{ $student->contact }}" class="w-full border p-2 rounded">
            </div>

            <!-- Address -->
            <div>
                <label class="block mb-1">پتہ</label>
                <textarea name="address" class="w-full border p-2 rounded">{{ $student->address }}</textarea>
            </div>

            <!-- Admission Date -->
            <div>
                <label class="block mb-1">داخلہ کی تاریخ</label>
                <input type="date" name="admission_date" value="{{ $student->admission_date }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Class -->
            <div>
                <label class="block mb-1">کلاس / درجہ</label>
                <input type="text" name="class_level" value="{{ $student->class_level }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1">اسٹیٹس</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>غیر فعال</option>
                </select>
            </div>

            <!-- Upload New Image -->
            <div>
                <label class="block mb-1">نئی تصویر (اگر تبدیل کرنی ہو)</label>
                <input type="file" name="student_image" class="w-full border p-2 rounded">
            </div>

            <!-- Upload New CNIC -->
            <div>
                <label class="block mb-1">نیا CNIC / B-Form</label>
                <input type="file" name="cnic_document" class="w-full border p-2 rounded">
            </div>

            <!-- Extra Docs -->
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
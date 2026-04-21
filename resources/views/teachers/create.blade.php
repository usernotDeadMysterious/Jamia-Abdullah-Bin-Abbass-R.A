<x-app-layout>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow" dir="rtl">

        <h2 class="text-2xl font-bold mb-6 text-right">
            نئے استاد کا اندراج
        </h2>

        <form action="{{ route('teachers.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <!-- Full Name -->
            <div>
                <label class="block mb-1">پورا نام</label>
                <input type="text" name="full_name" class="w-full border p-2 rounded">
            </div>

            <!-- CNIC -->
            <div>
                <label class="block mb-1">شناختی کارڈ نمبر</label>
                <input type="text" name="cnic" class="w-full border p-2 rounded">
            </div>

            <!-- Contact -->
            <div>
                <label class="block mb-1">رابطہ نمبر</label>
                <input type="text" name="contact" class="w-full border p-2 rounded">
            </div>

            <!-- Subjects -->
            <div>
                <label class="block mb-1">مضامین</label>
                <input type="text" name="subjects" placeholder="مثال: تجوید، حفظ" class="w-full border p-2 rounded">
            </div>

            <!-- Salary -->
            <div>
                <label class="block mb-1">تنخواہ</label>
                <input type="number" name="salary" class="w-full border p-2 rounded">
            </div>

            <!-- Joining Date -->
            <div>
                <label class="block mb-1">شمولیت کی تاریخ</label>
                <input type="date" name="joining_date" class="w-full border p-2 rounded">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1">اسٹیٹس</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="active">فعال</option>
                    <option value="inactive">غیر فعال</option>
                </select>
            </div>

            <!-- Teacher Image -->
            <div>
                <label class="block mb-1">استاد کی تصویر</label>
                <input type="file" name="teacher_image" accept="image/*" class="w-full border p-2 rounded">
            </div>

            <!-- CNIC -->
            <div>
                <label class="block mb-1">شناختی دستاویز (CNIC)</label>
                <input type="file" name="cnic_document" accept="image/*,application/pdf"
                    class="w-full border p-2 rounded">
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
                <button class="bg-green-600 text-white px-6 py-2 rounded">
                    محفوظ کریں
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
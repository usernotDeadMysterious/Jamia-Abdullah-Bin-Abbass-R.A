<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow" dir="rtl">

        <h2 class="text-2xl font-bold mb-6 text-right">
            طالب علم کا اندراج
        </h2>

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1">رجسٹریشن نمبر</label>
                <input type="text" value="خودکار طور پر بنے گا" readonly
                    class="w-full border p-2 rounded bg-gray-100 text-gray-500">
            </div>
            <!-- Full Name -->
            <div>
                <label class="block mb-1">پورا نام</label>
                <input type="text" name="full_name" class="w-full border p-2 rounded">
            </div>

            <!-- Father Name -->
            <div>
                <label class="block mb-1">والد کا نام</label>
                <input type="text" name="father_name" class="w-full border p-2 rounded">
            </div>

            <!-- DOB -->
            <div>
                <label class="block mb-1">تاریخ پیدائش</label>
                <input type="date" name="date_of_birth" class="w-full border p-2 rounded">
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

            <!-- Address -->
            <div>
                <label class="block mb-1">پتہ</label>
                <textarea name="address" class="w-full border p-2 rounded"></textarea>
            </div>

            <!-- Admission Date -->
            <div>
                <label class="block mb-1">داخلہ کی تاریخ</label>
                <input type="date" name="admission_date" class="w-full border p-2 rounded">
            </div>

            <!-- Class -->
            <div>
                <label class="block mb-1">کلاس / درجہ</label>
                <input type="text" name="class_level" class="w-full border p-2 rounded">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1">اسٹیٹس</label>
                <select name="status" class="w-full border p-2 rounded">
                    <option value="active">فعال</option>
                    <option value="inactive">غیر فعال</option>
                </select>
            </div>


            <!-- Student Image -->
            <div>
                <label class="block mb-1">طالب علم کی تصویر</label>
                <input type="file" name="student_image" accept="image/*" class="w-full border p-2 rounded">
            </div>

            <!-- CNIC / B-Form -->
            <div>
                <label class="block mb-1">شناختی دستاویز (CNIC / B-Form)</label>
                <input type="file" name="cnic_document" accept="image/*,application/pdf"
                    class="w-full border p-2 rounded">
            </div>

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

            let wrapper = document.createElement('div');

            let label = document.createElement('label');
            label.innerText = 'اضافی دستاویز';

            let input = document.createElement('input');
            input.type = 'file';
            input.name = 'extra_documents[]';
            input.className = 'w-full border p-2 rounded mt-1';

            wrapper.appendChild(label);
            wrapper.appendChild(input);

            container.appendChild(wrapper);
        }
    </script>
</x-app-layout>
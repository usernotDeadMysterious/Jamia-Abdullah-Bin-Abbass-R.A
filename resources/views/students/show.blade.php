<x-app-layout>

    <div class="max-w-6xl mx-auto space-y-6" dir="rtl">

        <!-- Header -->
        <div class="bg-white p-6 rounded-xl shadow flex flex-col md:flex-row justify-between items-center gap-4">

            <div>
                <h2 class="text-2xl font-bold">{{ $student->full_name }}</h2>
                <p class="text-gray-500 text-sm">{{ $student->registration_no }}</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('students.edit', $student->id) }}"
                    class="bg-yellow-500 text-white px-4 py-2 rounded text-sm">
                    ترمیم کریں
                </a>

                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                    onsubmit="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 text-white px-4 py-2 rounded text-sm">
                        حذف کریں
                    </button>

                    <a href="{{ route('students.idcard', $student->id) }}" target="_blank"
                        class="bg-indigo-600 text-white px-4 py-2 rounded text-sm">
                        شناختی کارڈ دیکھیں
                    </a>
                </form>
            </div>
        </div>

        <!-- Profile Section -->
        <div class="grid md:grid-cols-3 gap-6">

            <!-- Image -->
            <div class="bg-white p-4 rounded-xl shadow text-center">

                @php
                    $image = $student->documents->where('type', 'image')->first();
                @endphp

                @if($image)
                    <img src="{{ asset('storage/' . $image->file_path) }}"
                        class="w-40 h-40 mx-auto rounded-full object-cover border">
                @else
                    <div class="w-40 h-40 mx-auto rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No Image</span>
                    </div>
                @endif

                <h3 class="mt-4 font-semibold">{{ $student->full_name }}</h3>
                <p class="text-sm text-gray-500">{{ $student->class_level }}</p>
            </div>

            <!-- Info -->
            <div class="md:col-span-2 bg-white p-6 rounded-xl shadow">

                <h3 class="font-bold mb-4">بنیادی معلومات</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                    <div><strong>والد:</strong> {{ $student->father_name }}</div>
                    <div><strong>رابطہ:</strong> {{ $student->contact }}</div>
                    <div><strong>داخلہ:</strong> {{ $student->admission_date }}</div>

                    <div>
                        <strong>اسٹیٹس:</strong>
                        <span class="px-2 py-1 rounded text-white text-xs
                        {{ $student->status == 'active' ? 'bg-green-500' : 'bg-gray-500' }}">
                            {{ $student->status }}
                        </span>
                    </div>

                    <div><strong>شناختی نمبر:</strong> {{ $student->cnic }}</div>
                    <div><strong>تاریخ پیدائش:</strong> {{ $student->date_of_birth }}</div>

                    <div class="sm:col-span-2">
                        <strong>پتہ:</strong> {{ $student->address }}
                    </div>

                </div>
            </div>

        </div>

        <!-- CNIC -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-bold mb-4">شناختی دستاویز</h3>

            @php
                $cnic = $student->documents->where('type', 'cnic')->first();
            @endphp

            @if($cnic)
                <a href="{{ asset('storage/' . $cnic->file_path) }}" target="_blank"
                    class="bg-blue-500 text-white px-4 py-2 rounded text-sm">
                    دیکھیں / ڈاؤنلوڈ کریں
                </a>
            @else
                <p class="text-gray-500">کوئی دستاویز موجود نہیں</p>
            @endif
        </div>

        <!-- Other Docs -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="font-bold mb-4">دیگر دستاویزات</h3>

            @php
                $others = $student->documents->where('type', 'other');
            @endphp

            @if($others->count())
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">

                    @foreach($others as $doc)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                            class="block p-4 border rounded-lg hover:bg-gray-50">

                            <p class="text-sm font-medium">
                                دستاویز {{ $loop->iteration }}
                            </p>

                        </a>
                    @endforeach

                </div>
            @else
                <p class="text-gray-500">کوئی اضافی دستاویز نہیں</p>
            @endif
        </div>

    </div>

</x-app-layout>
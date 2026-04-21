<x-app-layout>

    <div class="max-w-6xl mx-auto space-y-6" dir="rtl">

        <!-- 🔷 Header -->
        <div class="bg-white p-6 rounded-2xl shadow flex flex-col md:flex-row justify-between items-center gap-4">

            <div class="text-center md:text-right">
                <h2 class="text-2xl font-bold">{{ $teacher->full_name }}</h2>
                <p class="text-gray-500 text-sm">استاد کی مکمل تفصیلات</p>
            </div>

            <div class="flex flex-wrap gap-2 justify-center">
                <a href="{{ route('teachers.edit', $teacher->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm">
                    ترمیم کریں
                </a>

                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                    onsubmit="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">
                    @csrf
                    @method('DELETE')

                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                        حذف کریں
                    </button>
                </form>
            </div>
        </div>

        <!-- 🔷 Profile + Info -->
        <div class="grid md:grid-cols-3 gap-6">

            <!-- 🖼️ Image Card -->
            <div class="bg-white p-6 rounded-2xl shadow text-center">

                @php
                    $image = $teacher->documents->where('type', 'image')->first();
                @endphp

                @if($image)
                    <img src="{{ asset('storage/' . $image->file_path) }}"
                        class="w-40 h-40 mx-auto rounded-full object-cover border">
                @else
                    <div class="w-40 h-40 mx-auto rounded-full bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-sm">No Image</span>
                    </div>
                @endif

                <h3 class="mt-4 font-semibold">{{ $teacher->full_name }}</h3>
                <p class="text-sm text-gray-500">{{ $teacher->subjects }}</p>
            </div>

            <!-- 📋 Info Card -->
            <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow">

                <h3 class="font-bold mb-4">بنیادی معلومات</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                    <div><strong>شناختی نمبر:</strong> {{ $teacher->cnic }}</div>
                    <div><strong>رابطہ:</strong> {{ $teacher->contact }}</div>

                    <div><strong>تنخواہ:</strong> {{ $teacher->salary }}</div>
                    <div><strong>شمولیت:</strong> {{ $teacher->joining_date }}</div>

                    <div class="sm:col-span-2">
                        <strong>مضامین:</strong> {{ $teacher->subjects }}
                    </div>

                    <div>
                        <strong>اسٹیٹس:</strong>
                        <span class="px-2 py-1 rounded text-white text-xs
                        {{ $teacher->status == 'active' ? 'bg-green-500' : 'bg-gray-500' }}">
                            {{ $teacher->status }}
                        </span>
                    </div>

                </div>
            </div>

        </div>

        <!-- 🪪 CNIC -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold mb-4">شناختی دستاویز</h3>

            @php
                $cnic = $teacher->documents->where('type', 'cnic')->first();
            @endphp

            @if($cnic)
                <a href="{{ asset('storage/' . $cnic->file_path) }}" target="_blank"
                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                    دیکھیں / ڈاؤنلوڈ کریں
                </a>
            @else
                <p class="text-gray-500">کوئی دستاویز موجود نہیں</p>
            @endif
        </div>

        <!-- 📂 Other Documents -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-bold mb-4">دیگر دستاویزات</h3>

            @php
                $others = $teacher->documents->where('type', 'other');
            @endphp

            @if($others->count())
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">

                    @foreach($others as $doc)
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                            class="block p-4 border rounded-xl hover:bg-gray-50 transition">

                            <p class="text-sm font-medium">
                                دستاویز {{ $loop->iteration }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                کلک کریں کھولنے کیلئے
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
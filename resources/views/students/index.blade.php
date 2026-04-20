<x-app-layout>
    <div dir="rtl">
        <h2 class="text-xl font-bold mb-4">طلبہ کی فہرست</h2>

        <a href="{{ route('students.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            نیا طالب علم
        </a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th>نام</th>
                    <th>والد</th>
                    <th>کلاس</th>
                    <th>اسٹیٹس</th>
                    <th>کارروائیاں</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr class="border-t">
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->father_name }}</td>
                        <td>{{ $student->class_level }}</td>
                        <td>{{ $student->status }}</td>

                        <td>
                            <div class="flex items-center gap-2">

                                <!-- View -->
                                <a href="{{ route('students.show', $student->id) }}"
                                    class="bg-blue-600 text-white px-3 py-1 text-sm rounded">
                                    دیکھیں
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('students.edit', $student->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 text-sm rounded">
                                    ترمیم
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                    onsubmit="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 text-sm rounded">
                                        حذف
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
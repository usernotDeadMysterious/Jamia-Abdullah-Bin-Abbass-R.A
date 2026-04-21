<x-app-layout>

    <div class="max-w-6xl mx-auto" dir="rtl">

        <h2 class="text-xl font-bold mb-4">اساتذہ کی فہرست</h2>

        <a href="{{ route('teachers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            نیا استاد
        </a>

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
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
                @foreach($teachers as $teacher)
                    <tr class="border-t">

                        <td>{{ $teacher->full_name }}</td>
                        <td>{{ $teacher->cnic }}</td>
                        <td>{{ $teacher->contact }}</td>
                        <td>{{ $teacher->subjects }}</td>
                        <td>{{ $teacher->salary }}</td>

                        <td>
                            <span class="px-2 py-1 text-xs rounded text-white
                                    {{ $teacher->status == 'active' ? 'bg-green-500' : 'bg-gray-500' }}">
                                {{ $teacher->status }}
                            </span>
                        </td>

                        <td>
                            <div class="flex items-center gap-2">

                                <!-- View (optional for now) -->
                                <a href="{{ route('teachers.show', $teacher->id) }}"
                                    class="bg-blue-600 text-white px-3 py-1 text-sm rounded">
                                    دیکھیں
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('teachers.edit', $teacher->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 text-sm rounded">
                                    ترمیم
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                    onsubmit="return confirm('کیا آپ واقعی حذف کرنا چاہتے ہیں؟')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-600 text-white px-3 py-1 text-sm rounded">
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
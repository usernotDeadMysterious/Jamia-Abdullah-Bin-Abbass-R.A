<x-app-layout>

    <div class="container" dir="rtl">

        {{-- 🔝 HEADER (same as expense page) --}}
        <div class="w-full flex flex-row justify-between gap-2 mb-3">

            <h2 class="text-start font-bold text-xl p-2">تفصیل تنخواہ</h2>

            <div>
                <a href="{{ url('/salary-report/pdf') . '?' . http_build_query(request()->all()) }}" target="_blank"
                    class="btn btn-success">
                    رپورٹ دیکھیں
                </a>

                <a href="{{ url('/salary-report/pdf') . '?' . http_build_query(array_merge(request()->all(), ['download' => 1])) }}"
                    target="_blank" class="btn btn-dark">
                    ڈاؤن لوڈ رپورٹ
                </a>
            </div>

        </div>


        {{-- ✅ FILTERS (same layout as expense) --}}
        <form method="GET" class="row g-2 mb-4 align-items-end">

            <div class="col-md-2">
                <a href="/expense/create?category=salary" class="btn btn-success w-100 shadow-sm">
                    + نئی تنخواہ
                </a>
            </div>

            {{-- 🔍 Search --}}
            <div class="col-md-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm"
                    placeholder="استاد کا نام">
            </div>

            {{-- 📅 FROM --}}
            <div class="col-md-2">
                <input type="date" name="from" value="{{ request('from') }}" class="form-control shadow-sm">
            </div>

            {{-- 📅 TO --}}
            <div class="col-md-2">
                <input type="date" name="to" value="{{ request('to') }}" class="form-control shadow-sm">
            </div>

            {{-- 🔘 FILTER --}}
            <div class="col-md-2">
                <button class="btn btn-primary w-100 shadow-sm">فلٹر</button>
            </div>

            {{-- 🔄 RESET --}}
            <div class="col-md-1">
                <a href="{{ route('salary.report') }}" class="btn btn-outline-secondary w-100">
                    ری سیٹ
                </a>
            </div>

        </form>



        <!-- 📊 TABLE -->
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>تاریخ</th>
                            <th>استاد</th>
                            <th>رقم</th>
                            <th>تفصیل</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expense->date }}</td>
                                <td>{{ $expense->given_to }}</td>
                                <td class="text-danger fw-bold">
                                    {{ number_format($expense->amount) }}
                                </td>
                                <td>{{ $expense->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">کوئی ریکارڈ موجود نہیں</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        <!-- 💰 TOTAL -->
        <div class="card bg-danger text-white p-3 text-center mb-3 mt-8">
            <h5>کل تنخواہ</h5>
            <h4>{{ number_format($totalSalary) }}</h4>
        </div>

    </div>


</x-app-layout>
<x-app-layout>

    <div class="container" dir="rtl">

        <h2 class="mb-4 text-center">خرچ رپورٹ</h2>

        {{-- 🔍 Filters --}}
        <form method="GET" class="row g-2 mb-4">

            <div class="col-md-3">
                <label>سے</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label>تک</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>

            <div class="d-flex gap-2 mb-3">

                {{-- 👁️ VIEW --}}
                <a href="{{ url('/reports/expense/pdf-browser') . '?' . http_build_query(request()->all()) }}"
                    target="_blank" class="btn btn-success">
                    👁️ دیکھیں
                </a>

                {{-- ⬇️ DOWNLOAD --}}
                <a href="{{ url('/reports/expense/pdf-browser') . '?' . http_build_query(array_merge(request()->all(), ['download' => 1])) }}"
                    target="_blank" class="btn btn-dark">
                    ⬇️ ڈاؤن لوڈ
                </a>

            </div>

        </form>



        {{-- 📊 Table --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>تاریخ</th>
                            <th>عنوان</th>
                            <th>کس کو دیا</th>
                            <th>قسم</th>
                            <th>رقم</th>
                            <th>تفصیل</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expense->date }}</td>
                                <td>{{ $expense->title }}</td>
                                <td>{{ $expense->given_to }}</td>
                                <td>{{ $expense->category }}</td>
                                <td class="text-danger fw-bold">
                                    {{ number_format($expense->amount) }}
                                </td>
                                <td>{{ $expense->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">کوئی ڈیٹا موجود نہیں</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
        {{-- 💰 TOTAL --}}
        <div class="row mb-3 text-center">
            <div class="col-md-12">
                <div class="card bg-danger text-white p-3">
                    <h5>کل خرچ</h5>
                    <h4>{{ number_format($totalExpense) }}</h4>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
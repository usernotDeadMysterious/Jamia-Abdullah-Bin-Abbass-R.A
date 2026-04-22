<x-app-layout>

    <div class="w-full flex flex-row justify-between gap-2 mb-3">

        <h2 class="text-start font-bold text-xl p-2">تفصیل اخراجات</h2>

        <div>
            <a href="{{ url('/reports/expense/pdf-browser') . '?' . http_build_query(request()->all()) }}"
                target="_blank" class="btn btn-success">
                رپورٹ دیکھیں
            </a>

            <a href="{{ url('/reports/expense/pdf-browser') . '?' . http_build_query(array_merge(request()->all(), ['download' => 1])) }}"
                target="_blank" class="btn btn-dark">
                ڈاؤن لوڈ رپورٹ
            </a>
        </div>

    </div>


    {{-- ✅ Filters --}}
    <form method="GET" class="row g-2 mb-4 align-items-end">

        <div class="col-md-2">
            <a href="/expense/create" class="btn btn-success w-100 shadow-sm">
                + نئے اخراجات
            </a>
        </div>

        {{-- Search --}}
        <div class="col-md-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm"
                placeholder="تلاش کریں...">
        </div>

        {{-- FROM --}}
        <div class="col-md-2">
            <input type="date" name="from" value="{{ request('from') }}" class="form-control shadow-sm">
        </div>

        {{-- TO --}}
        <div class="col-md-2">
            <input type="date" name="to" value="{{ request('to') }}" class="form-control shadow-sm">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100 shadow-sm">فلٹر</button>
        </div>

        <div class="col-md-1">
            <a href="/expense" class="btn btn-outline-secondary w-100">ری سیٹ</a>
        </div>

    </form>

    {{-- 💰 Total Expense --}}
    {{-- <div class="alert alert-danger text-center">
        کل خرچ: <strong>{{ number_format($totalExpense) }} روپے</strong>
    </div> --}}

    {{-- 📊 Table --}}
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>تاریخ</th>
                        {{-- <th>عنوان</th> --}}
                        <th>نام</th>
                        <th>کیٹیگری</th>
                        <th>رقم</th>
                        <th>تفصیل</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($expenses as $expense)
                        <tr>
                            <td>{{ $expenses->firstItem() + $loop->index }}</td>
                            <td>{{ $expense->date }}</td>
                            {{-- <td>{{ $expense->title }}</td> --}}
                            <td>{{ $expense->given_to }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $expense->category }}
                                </span>
                            </td>
                            <td class="text-danger fw-bold">
                                {{ number_format($expense->amount) }}
                            </td>
                            <td>{{ $expense->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">کوئی ریکارڈ موجود نہیں</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            <div class="mt-3 d-flex justify-content-center">
                {{ $expenses->links() }}
            </div>
        </div>
    </div>

</x-app-layout>
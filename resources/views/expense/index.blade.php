<x-app-layout>

    <h2 class="text-center mb-4">تفصیل اخراجات</h2>


    {{-- ✅ Filters --}}
    <form method="GET" class="row g-2 mb-4 align-items-end">

        <div class="col-md-2">
            <a href="/expense/create" class="btn btn-success w-100 shadow-sm">
                + نئے اخراجات
            </a>
        </div>

        {{-- 🔍 Search --}}
        <div class="col-md-3">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm"
                placeholder="تلاش کریں...">
        </div>

        {{-- 📅 Month --}}
        <div class="col-md-2">
            <select name="month" class="form-control shadow-sm">
                <option value="">مہینہ</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- 📅 Year --}}
        <div class="col-md-2">
            <select name="year" class="form-control shadow-sm">
                <option value="">سال</option>
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>

        {{-- 🔘 Buttons --}}
        <div class="col-md-3 d-flex gap-2">
            <button class="btn btn-primary w-100 shadow-sm">فلٹر</button>
            <a href="{{ route('expense.index') }}" class="btn btn-outline-secondary w-100">
                ری سیٹ
            </a>
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
                        <th>عنوان</th>
                        <th>کس کو دیا</th>
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
                            <td>{{ $expense->title }}</td>
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
<x-app-layout>

    <h2 class="text-center mb-4">خرچ رپورٹ</h2>

    {{-- ✅ Filters --}}
    <form method="GET" class="row mb-4 justify-content-center">

        <div class="col-md-3">
            <select name="month" class="form-control">
                <option value="">مہینہ منتخب کریں</option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-3">
            <select name="year" class="form-control">
                <option value="">سال منتخب کریں</option>
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">فلٹر کریں</button>
        </div>

    </form>

    {{-- 💰 Total Expense --}}
    <div class="alert alert-danger text-center">
        کل خرچ: <strong>{{ number_format($totalExpense) }} روپے</strong>
    </div>

    {{-- 📊 Table --}}
    <div class="card p-3">
        <table class="table table-bordered text-center">

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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->title }}</td>
                        <td>{{ $expense->given_to }}</td>
                        <td>{{ $expense->category }}</td>
                        <td>{{ number_format($expense->amount) }}</td>
                        <td>{{ $expense->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">کوئی ریکارڈ موجود نہیں</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</x-app-layout>
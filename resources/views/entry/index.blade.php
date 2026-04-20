<x-app-layout>



    @php
        $months = [
            1 => 'جنوری',
            2 => 'فروری',
            3 => 'مارچ',
            4 => 'اپریل',
            5 => 'مئی',
            6 => 'جون',
            7 => 'جولائی',
            8 => 'اگست',
            9 => 'ستمبر',
            10 => 'اکتوبر',
            11 => 'نومبر',
            12 => 'دسمبر'
        ];
    @endphp

    <!-- 🔥 FILTER FORM -->
    <div class="card p-3 mb-4">
        <h2 class="text-start    font-bold text-xl p-2 mb-4 "> موصول ریکارڈ</h2>
        <form method="GET" action="/entry" class="row">
            <div class="col-md-2 bg-none mt-4">
                <a href="/entry/create" class="btn btn-secondary w-100">+ نئے موصول</a>
            </div>
            <div class="col-md-4">
                <label>مہینہ</label>
                <select name="month" class="form-control">
                    <option value="">منتخب کریں</option>

                    @foreach($months as $num => $name)
                        <option value="{{ $num }}" {{ ($month == $num) ? 'selected' : '' }}>
                            {{ $name }} ({{ $num }})
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="col-md-4">
                <label>سال</label>
                <input type="number" name="year" value="{{ $year ?? '' }}" class="form-control">
            </div>

            <div class="col-md-2 mt-4">
                <button class="btn btn-primary w-100">فلٹر کریں</button>
            </div>

        </form>
    </div>

    <!-- 🔥 SELECTED MONTH -->
    @if($month && $year)
        <h5 class="text-center mb-3">
            ماہ: {{ $months[$month] ?? '' }} ({{ $month }}) - {{ $year }}
        </h5>
    @endif

    <!-- 🔥 TABLE -->
    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>تاریخ</th>
                        <th>نام معاونین</th>
                        <th>رسید نمبر</th>
                        <th>قسم</th>
                        <th>رقم</th>
                        <th>تفصیل</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($entries as $entry)
                        <tr>
                            <td>{{ $entry->date }}</td>
                            <td>{{ $entry->name }}</td>
                            <td>{{ $entry->receipt_no }}</td>
                            <td>{{ $entry->type }}</td>
                            <td>{{ $entry->amount }}</td>
                            <td>{{ $entry->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">کوئی ریکارڈ موجود نہیں</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 🔥 SUMMARY -->
    <div class="row mt-4 text-center">
        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <h5>مجموع آمدن</h5>
                <h4>{{ $totalIncome }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white p-3">
                <h5>مجموع اخراجات</h5>
                <h4>{{ $totalExpense }}</h4>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark text-white p-3">
                <h5>بقیہ رقم</h5>
                <h4>{{ $totalIncome - $totalExpense }}</h4>
            </div>
        </div>
    </div>

</x-app-layout>
<x-app-layout>

    <h2 class="text-center mb-4">صدقہ / زکوٰۃ رپورٹ</h2>

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

    <!-- 🔥 FILTER -->
    <div class="card p-3 mb-4">
        <form method="GET" action="/sadqa" class="row">

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

            <div class="col-md-4 mt-4">
                <button class="btn btn-primary w-100">فلٹر کریں</button>
            </div>

        </form>
    </div>

    <!-- 🔥 TABLE -->
    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>تاریخ</th>
                        <th>قسم</th>
                        <th>رقم</th>
                        <th>دینے والا</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($sadqat as $item)
                        <tr>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->donor }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">کوئی ریکارڈ موجود نہیں</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 🔥 TOTAL -->
    <div class="row mt-4 text-center">
        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <h5>کل صدقات</h5>
                <h4>{{ $totalSadqa }}</h4>
            </div>
        </div>
    </div>

</x-app-layout>
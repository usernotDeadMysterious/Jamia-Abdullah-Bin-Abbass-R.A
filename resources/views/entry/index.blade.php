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

        {{-- Reports buttons --}}
        <div class="w-full flex flex-row  justify-between gap-2 ml-5 mb-2">
            <h2 class="text-start    font-bold text-xl p-2 mb-4 ">تفصیل آمد</h2>
            <div>
                <a href="{{ url('/reports/income/pdf-browser') . '?' . http_build_query(request()->all()) }}"
                    target="_blank" class="btn btn-success ">
                    رپورٹ دیکھیں
                </a>

                <a href="{{ url('/reports/income/pdf-browser') . '?' . http_build_query(array_merge(request()->all(), ['download' => 1])) }}"
                    target="_blank" class="btn btn-dark ">
                    ڈاؤن لوڈ رپورٹ
                </a>
            </div>

        </div>
        <form method="GET" action="{{ url('/entry') }}" class="row g-2 align-items-end">

            <div class="col-md-2">
                <a href="/entry/create" class="btn btn-success w-100 shadow-sm">
                    + نیا وصول
                </a>
            </div>

            {{-- 🔍 Search --}}
            <div class="col-md-3">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control shadow-sm"
                    placeholder="نام / رسید / قسم">
            </div>

            {{-- 📅 Month --}}
            {{-- <div class="col-md-2">
                <select name="month" class="form-control shadow-sm">
                    <option value="">مہینہ</option>
                    @foreach($months as $num => $name)
                    <option value="{{ $num }}" {{ ($month==$num) ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                    @endforeach
                </select>
            </div> --}}

            {{-- 📅 Year --}}
            {{-- <div class="col-md-1">
                <input type="number" name="year" value="{{ $year ?? '' }}" class="form-control shadow-sm"
                    placeholder="سال">
            </div> --}}

            {{-- 📅 FROM --}}
            <div class="col-md-2">
                <input type="date" name="from" value="{{ request('from') }}" class="form-control shadow-sm">
            </div>
            سے

            {{-- 📅 TO --}}
            <div class="col-md-2">
                <input type="date" name="to" value="{{ request('to') }}" class="form-control shadow-sm">
            </div>
            تک
            {{-- 🔘 Buttons --}}
            <div class="col-md-1 d-flex gap-2">
                <button class="btn btn-primary w-100 shadow-sm">فلٹر</button>
            </div>

            <div class="col-md-1 d-flex gap-2 mt-2">
                <a href="/entry" class="btn btn-outline-secondary w-100 ">ری سیٹ</a>
            </div>



        </form>

    </div>

    @if($from || $to)
        <h5 class="text-center mb-3">
            مدت:
            {{ $from ?? 'شروع' }}
            سے
            {{ $to ?? 'آج تک' }}
        </h5>
    @endif
    <!-- 🔥 SELECTED MONTH -->
    @if($month && $year && isset($months[(int) $month]))
        <h5 class="text-center mb-3">
            ماہ: {{ $months[(int) $month] }} ({{ $month }}) - {{ $year }}
        </h5>
    @endif

    <!-- 🔥 TABLE -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center mb-0">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
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
                            <td>{{ $entries->firstItem() + $loop->index }}</td>
                            <td>{{ $entry->date }}</td>
                            <td>{{ $entry->name }}</td>
                            <td>{{ $entry->receipt_no }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $entry->type }}
                                </span>
                            </td>
                            <td class="fw-bold text-success">
                                {{ number_format($entry->amount) }}
                            </td>
                            <td>{{ $entry->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">کوئی ریکارڈ موجود نہیں</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
    {{-- pagination --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $entries->links() }}
    </div>

    <!-- 🔥 SUMMARY -->
    {{-- <div class="row mt-4 text-center">
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
    </div> --}}

</x-app-layout>
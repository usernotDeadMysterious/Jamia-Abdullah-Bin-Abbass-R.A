<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ماہانہ رجسٹر رپورٹ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2 class="text-center mb-4">ماہانہ رجسٹر رپورٹ</h2>

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
<form method="GET" action="/entry" class="row mb-4">
    
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

<!-- 🔥 SELECTED MONTH HEADING -->
@if($month && $year)
    <h4 class="text-center mb-3">
        ماہ: {{ $months[$month] ?? '' }} ({{ $month }}) - {{ $year }}
    </h4>
@endif

<!-- 🔥 TABLE -->
<table class="table table-bordered text-center">
    <thead>
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

<hr>

<h4>مجموع آمدن: {{ $totalIncome }}</h4>
<h4>مجموع اخراجات: {{ $totalExpense }}</h4>
<h4>بقیہ رقم: {{ $totalIncome - $totalExpense }}</h4>

</body>
</html>
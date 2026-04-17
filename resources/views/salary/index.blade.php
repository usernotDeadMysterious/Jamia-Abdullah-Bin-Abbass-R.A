<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>رجسٹر ادائیگی تنخواہ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        /* 🔥 REMOVE NUMBER INPUT ARROWS (ALL BROWSERS) */
        input[type=number] {
            appearance: textfield;
            -webkit-appearance: none;
            -moz-appearance: textfield;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            display: none;
            -webkit-appearance: none;
            margin: 0;
        }

        /* 🔥 REMOVE SELECT DROPDOWN ICON */
        select.form-control {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-image: none !important;
        }

        /* Optional: clean input look */
        input, select {
            border-radius: 6px;
        }
    </style>
</head>

<body class="container mt-4">

<h2 class="text-center mb-4">رجسٹر ادائیگی تنخواہ</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

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

<form method="POST" action="/salary/store">
@csrf

<div class="row mb-3">
    <div class="col-md-6">
        <label>بابت ماہ</label>
        <select name="month" class="form-control" required>
            @foreach($months as $num => $name)
                <option value="{{ $num }}">{{ $name }} ({{ $num }})</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label>سنہ</label>
        <input type="number" name="year" class="form-control" placeholder="2026" required>
    </div>
</div>

<label>نام</label>
<input type="text" name="name" class="form-control" required>

<label>عہدہ</label>
<input type="text" name="designation" class="form-control">

<label>تعداد دن</label>
<input type="number" name="days" class="form-control">

<label>شرح</label>
<input type="number" name="rate" class="form-control">

<label>الاونس</label>
<input type="number" name="allowance" class="form-control" value="0">

<label>پیشگی</label>
<input type="number" name="advance" class="form-control" value="0">

<button class="btn btn-success mt-3 w-100">محفوظ کریں</button>

</form>

</body>
</html>
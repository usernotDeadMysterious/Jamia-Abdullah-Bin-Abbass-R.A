<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>رجسٹر ادائیگی تنخواہ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2 class="text-center mb-4">رجسٹر ادائیگی تنخواہ</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="/salary/store">

    @csrf  <!-- 🔥 VERY IMPORTANT -->

    <label>نام</label>
    <input type="text" name="name" class="form-control" required>

    <label>عہدہ</label>
    <input type="text" name="designation" class="form-control">

    <label>دن</label>
    <input type="number" name="days" class="form-control">

    <label>شرح</label>
    <input type="number" name="rate" class="form-control">

    <label>الاونس</label>
    <input type="number" name="allowance" class="form-control" value="0">

    <label>پیشگی</label>
    <input type="number" name="advance" class="form-control" value="0">

    <label>مہینہ</label>
    <input type="number" name="month" class="form-control" required>

    <label>سال</label>
    <input type="number" name="year" class="form-control" required>

    <button class="btn btn-success mt-3 w-100">محفوظ کریں</button>

</form>

</body>
</html>
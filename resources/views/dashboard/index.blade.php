<!DOCTYPE html>
<html lang="ur" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>ڈیش بورڈ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .sidebar {
            height: 100vh;
            background: #1e293b;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: #cbd5f5;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 6px;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <!-- 🔥 SIDEBAR -->
        <div class="col-md-2 sidebar">
            <h4 class="mb-4">مدرسہ سسٹم</h4>

            <a href="/dashboard">ڈیش بورڈ</a>
            <a href="/entry">رجسٹر رپورٹ</a>
            <a href="/entry/create">نیا اندراج</a>
            <a href="/sadqa/create">صدقہ درج کریں</a>
            <a href="/salary">تنخواہ رپورٹ</a>
            <a href="/salary/create">تنخواہ درج کریں</a>
        </div>

        <!-- 🔥 MAIN CONTENT -->
        <div class="col-md-10 p-4">

            <h3 class="mb-4">ڈیش بورڈ</h3>

            <div class="row">

                <div class="col-md-3">
                    <div class="card bg-success text-white p-3">
                        <h5>کل آمدن</h5>
                        <h3>{{ $totalIncome }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-danger text-white p-3">
                        <h5>کل اخراجات</h5>
                        <h3>{{ $totalExpense }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-primary text-white p-3">
                        <h5>کل صدقات</h5>
                        <h3>{{ $totalSadqa }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card bg-warning text-dark p-3">
                        <h5>کل تنخواہ</h5>
                        <h3>{{ $totalSalary }}</h3>
                    </div>
                </div>

            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card bg-dark text-white p-3">
                        <h5>بقیہ رقم</h5>
                        <h2>{{ $balance }}</h2>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>
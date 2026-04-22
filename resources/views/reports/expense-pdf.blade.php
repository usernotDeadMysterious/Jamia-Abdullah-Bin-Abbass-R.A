<!DOCTYPE html>
<html lang="ur" dir="rtl">

<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: 'Noto Nastaliq Urdu', serif;
            direction: rtl;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <th>#</th>
            <th>عنوان</th>
            <th>کس کو دیا</th>
            <th>قسم</th>
            <th>رقم</th>
            <th>تاریخ</th>
            <th>تفصیل</th>
        </tr>

        @foreach($expenses as $i => $expense)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $expense->title }}</td>
                <td>{{ $expense->given_to }}</td>
                <td>{{ $expense->category }}</td>
                <td>{{ number_format($expense->amount) }}</td>
                <td>{{ $expense->date }}</td>
                <td>{{ $expense->description }}</td>
            </tr>
        @endforeach
    </table>

    <table style="margin-top:10px;">
        <tr>
            <td style="text-align:right;">
                <strong>کل خرچ:</strong> {{ number_format($totalExpense) }}
            </td>
        </tr>
    </table>

</body>

</html>
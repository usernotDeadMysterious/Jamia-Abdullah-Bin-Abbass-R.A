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

            <th>نام</th>
            <th>تفصیل</th>
            <th>رقم</th>
            <th>تاریخ</th>
            <th>سسٹم نمبر</th>
            <th>رسید نمبر</th>

        </tr>

        @foreach($entries as $i => $entry)
            <tr>
                <td>{{ $i + 1 }}</td>

                <td>{{ $entry->name }}</td>
                <td>{{ $entry->description }}</td>
                <td>{{ $entry->amount }}</td>
                <td>{{ $entry->date }}</td>
                <td>{{ $entry->id }}</td>
                <td>{{ $entry->receipt_no }}</td>
            </tr>
        @endforeach
    </table>

    <table style="margin-top:10px; width:100%;">
        <tr>
            <td style="text-align:right;">
                <strong>کل رقم:</strong> {{ number_format($totalCash) }}
            </td>
        </tr>
        <tr>
            <td style="text-align:right;">
                <strong>کل عطیات:</strong> {{ $totalItems }}
            </td>
        </tr>
    </table>



</body>

</html>
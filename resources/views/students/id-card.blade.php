<!DOCTYPE html>
<html lang="ur" dir="rtl">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Noto Nastaliq Urdu', serif;
            margin: 0;
            padding: 20px;
            background: #f1f5f9;
            text-align: center;
        }

        /* Foldable Print Container - Side by Side */
        .print-container {
            display: table;
            background: white;
            border-radius: 0px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            border: 1px solid #cbd5e1;
            /* Total width for both halves (e.g., 220px each) */
            width: 500px;
        }

        /* Each half (Front and Back) */
        .half {
            display: table-cell;
            width: 250px;
            height: 380px;
            /* Standard portrait height */
            position: relative;
            box-sizing: border-box;
            padding: 15px;
            vertical-align: top;
        }

        /* ================= FRONT ================= */
        .front {
            background-color: #1e293b;
            /* DomPDF Fallback */
            background: linear-gradient(135deg, #1e293b, #334155);
            /* Lighter slate-blue */
            color: white;
            /* Vertical Fold Line (Left side because RTL puts Front on the Right) */
            border-left: 2px dashed #94a3b8;

        }

        .header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 14px;
            letter-spacing: 0.5px;
            padding-bottom: 5px;
            border-bottom: 0.5px solid #e2e8f0;
        }

        .header .sub {
            font-size: 10px;
            opacity: 0.8;
            margin-top: 2px;
        }

        .photo-wrapper {
            text-align: center;
            margin-bottom: 15px;
        }

        .photo {
            width: 90px;
            height: 110px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #ffffff;
            background: #cbd5e1;
            /* fallback color */
        }

        /* Safe Table layout for DomPDF alignment */
        .info-table {
            width: 100%;
            font-size: 12px;
            line-height: 1.5;
            color: #f8fafc;
        }

        .info-table td {
            vertical-align: top;
        }

        .info-label {
            width: 35%;
            color: #cbd5e1;
            /* Lightened the labels slightly to match new bg */
        }

        .info-value {
            font-weight: bold;
            /* text-align: right */
        }

        .highlight-text {
            color: #fafafa;
        }

        /* Fix for Numbers showing backwards */
        .ltr-fix {
            direction: ltr;
            unicode-bidi: embed;
            display: inline-block;
            text-align: right;
        }

        /* Sign & Stamp */
        .auth-section {
            position: absolute;
            bottom: 15px;
            left: 15px;
            right: 15px;
            display: table;
            width: calc(100% - 30px);
        }

        .auth-box {
            display: table-cell;
            text-align: center;
            font-size: 10px;
            width: 50%;
            vertical-align: bottom;
        }

        .auth-line {
            border-top: 1px solid #cbd5e1;
            width: 60px;
            margin: 0 auto 4px auto;
        }

        /* ================= BACK ================= */
        .back {
            background: #ffffff;
            color: #0f172a;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .back-title {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .qr-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .qr-section img {
            border: 3px solid #0f172a;
            padding: 4px;
            border-radius: 8px;
            width: 110px;
        }

        .scan-text {
            font-size: 10px;
            font-weight: bold;
            margin-top: 5px;
            color: #475569;
        }

        .back-details {
            font-size: 11px;
            line-height: 2;
            text-align: center;
            color: #334155;
            padding: 0 10px;
        }

        .expiry {
            position: absolute;
            bottom: 15px;
            width: 100%;
            left: 0;
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            color: #b91c1c;
        }
    </style>
</head>

<body>

    @php
        $image = $student->documents->where('type', 'image')->first();
        $expiry = \Carbon\Carbon::parse($student->admission_date)->addYear()->format('d-m-Y');
        $qrData = url('/verify/student/' . encrypt($student->id));
    @endphp

    <div class="print-container">

        <div class="half front">

            <div class="header">
                جامعہ عبد اللہ بن عباسؓ
                <div class="sub">پشاور</div>
            </div>

            <div class="photo-wrapper">
                @if($image)
                    <img src="{{ public_path('storage/' . $image->file_path) }}" class="photo">
                @else
                    <div class="photo"></div>
                @endif
            </div>

            <table class="info-table">
                <tr>
                    <td class="info-label">نام:</td>
                    <td class="info-value">{{ $student->full_name }}</td>
                </tr>
                <tr>
                    <td class="info-label">والد کا نام:</td>
                    <td class="info-value">{{ $student->father_name }}</td>
                </tr>
                <tr>
                    <td class="info-label">شناختی نمبر:</td>
                    <td class="info-value"><span class="ltr-fix">{{ $student->cnic ?? '—' }}</span></td>
                </tr>
                <tr>
                    <td class="info-label">رجسٹریشن:</td>
                    <td class="info-value highlight-text"><span class="ltr-fix">{{ $student->registration_no }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="info-label">کلاس:</td>
                    <td class="info-value">{{ $student->class_level }}</td>
                </tr>
            </table>

            <div class="auth-section">
                <div class="auth-box">
                    <div class="auth-line"></div>
                    مہر
                </div>
                <div class="auth-box">
                    <div class="auth-line"></div>
                    دستخط
                </div>
            </div>

        </div>

        <div class="half back">

            <div class="back-title">
                تصدیق / Verification
            </div>

            <div class="qr-section">
                <img src="data:image/svg+xml;base64,{{ \App\Helpers\QrHelper::generate($qrData) }}">
                <div class="scan-text">Scan to Verify</div>
            </div>

            <div class="back-details">
                <strong>ادارہ:</strong> جامعہ عبد اللہ بن عباسؓ<br>
                <strong>فون:</strong> <span class="ltr-fix">0321-9116027</span><br>
                <strong>پتہ:</strong> یونیورسٹی روڈ، پشاور
            </div>

            <div class="expiry">
                <span class="ltr-fix">{{ $expiry }}</span> :میعاد ختم
            </div>

        </div>

    </div>

</body>

</html>
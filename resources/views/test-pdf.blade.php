<!DOCTYPE html>
<html lang="ur" dir="rtl">

<head>
    <meta charset="UTF-8">
    <!-- 🔤 Fonts (you can switch manually) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600&family=Amiri&family=Cairo:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @font-face {
            font-family: 'urdu';
            src: url("{{ public_path('fonts/urdu.ttf') }}") format('truetype');
        }

        body {
            /* font-family: 'Noto Sans Arabic', sans-serif; */
            /* font-family: 'Amiri', serif; */
            /* font-family: 'Cairo', sans-serif; */
            font-family: 'urdu';
            direction: rtl;
            text-align: right;
            font-size: 20px;
            letter-spacing: 0;
            word-spacing: 0;
        }
    </style>
</head>

<body>

    <h2>{!! $title !!}</h2>

    <p>
        {!! $text !!}
    </p>

    <p>
        123456789
    </p>

</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- 🔤 Fonts (you can switch manually) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600&family=Amiri&family=Cairo:wght@400;600&display=swap"
        rel="stylesheet" />

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class=" text-gray-900 ">
    <style>
        body {
            /* 👉 CHANGE THIS manually to test */
            /* font-family: 'Noto Sans Arabic', sans-serif; */
            /* font-family: 'Amiri', serif; */
            font-family: 'Cairo', sans-serif;
            font-weight: 400;
            font-size: large;
            background: #f1f5f9;
        }
    </style>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-100 via-green-100 to-emerald-200">
        <a href="/">
            <div class="flex flex-col items-center justify-center  ">

                <img src="/auth-logo-bg.png" alt="" class="w-22 h-20 fill-current text-gray-500">
                <p class="font-bold text-xl"> جامعہ عبداللہ بن عباس رضی اللہ عنہ</p>
                <p> Abdullah bin Abbass R.A University</p>
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}

            </div>
        </a>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
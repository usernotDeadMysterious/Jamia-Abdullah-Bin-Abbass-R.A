<!DOCTYPE html>
<html lang="ur" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Jamia</title>

    <!-- 🔤 Fonts (you can switch manually) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600&family=Amiri&family=Cairo:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            /* 👉 CHANGE THIS manually to test */
            /* font-family: 'Noto Sans Arabic', sans-serif; */
            font-family: 'Amiri', serif;
            /* font-family: 'Cairo', sans-serif; */
            font-weight: 400;
            font-size: large;
            background: #f1f5f9;
        }

        /* 🔥 Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 250px;
            height: 100vh;
            background: #0f172a;
            color: white;
            z-index: 1000;

            display: flex;
            flex-direction: column;
            /* 🔥 important */
        }

        /* Scrollable menu area */
        .sidebar-menu {
            flex: 1;
            /* take remaining space */
            overflow-y: auto;
            padding: 20px;
        }

        /* Smooth scroll */
        .sidebar-menu {
            scroll-behavior: smooth;
        }

        /* Optional: nicer scrollbar */
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }

        /* Logout fixed at bottom */
        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid #1e293b;
            background: #0f172a;
        }

        .sidebar.closed {
            right: -250px;
        }

        .sidebar h4 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #cbd5f5;
            padding: 12px;
            text-decoration: none;
            margin-bottom: 6px;
            border-radius: 8px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #1e293b;
            color: #fff;
        }

        /* 🔥 Logout button */
        .logout-btn {
            margin-top: 20px;
            background: #ef4444;
            border: none;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            color: white;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* 🔥 Hamburger button */
        .menu-btn {
            position: fixed;
            top: 15px;
            right: 15px;
            background: #0f172a;
            color: white;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            z-index: 1100;
        }

        /* 🔥 Main content shift */
        .content {
            margin-right: 250px;
            transition: 0.3s;
        }

        .content.full {
            margin-right: 0;
        }

        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <!-- 🔥 Hamburger -->
    <button class="menu-btn" onclick="toggleSidebar()">☰</button>

    <!-- 🔥 SIDEBAR -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-menu">

            {{-- 🧭 Dashboard --}}
            <span class="text-sm">منتظم</span>
            <a href="{{ url('/dashboard') }}"> ڈیش بورڈ</a>

            {{-- ➕ FORMS / CREATE --}}
            <span class="text-sm mt-3"> اندراج</span>

            <a href="{{ url('/entry/create') }}"> نیا وصول</a>
            <a href="{{ url('/expense/create') }}"> نیا خرچ</a>

            <a href="{{ route('students.create') }}"> نیا طالب علم</a>
            <a href="{{ route('teachers.create') }}"> نیا استاد</a>

            {{-- 💰 Salary Entry --}}
            <a href="{{ url('/expense/create?category=salary') }}">
                تنخواہ ادا کریں
            </a>

            {{-- 📊 RECORDS --}}
            <span class="text-sm mt-3"> ریکارڈز</span>

            <a href="{{ url('/entry') }}"> تفصیل آمد</a>
            <a href="{{ url('/expense') }}"> تفصیل اخراجات</a>

            <a href="{{ route('students.index') }}"> طلباء کی فہرست</a>
            <a href="{{ route('teachers.index') }}"> اساتذہ کی فہرست</a>
            <span class="text-sm mt-3"> رپورٹس</span>

            <a href="{{ route('reports.income') }}"
                class="{{ request()->routeIs('reports.income') ? 'bg-slate-700 text-white' : '' }}">
                آمد رپورٹ
            </a>

            <a href="{{ route('reports.expense') }}"
                class="{{ request()->routeIs('reports.expense') ? 'bg-slate-700 text-white' : '' }}">
                خرچ رپورٹ
            </a>

        </div>
        <!-- 🔽 FIXED FOOTER -->
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">لاگ آؤٹ</button>
            </form>
        </div>




    </div>


    <!-- 🔥 MAIN CONTENT -->
    <div id="content" class="content p-4">
        <!-- Header -->
        <div class="mb-4 p-4 bg-white shadow-sm rounded-3 d-flex align-items-center justify-around">

            <!-- 🏫 Text Info -->
            <div class="text-start">
                <h2 class="mb-1 font-bold text-2xl">جامعہ عبد اللہ بن عباسؓ</h2>
                <p class="mb-0 text-muted">یونیورسٹی روڈ، تھکل پایان، پشاور</p>
                <small class="text-secondary">0321-9116027</small>
            </div>

            <!-- 🖼️ Logo (right side in RTL) -->
            <div>
                <img src="/logo.png" alt="Jamia Logo"
                    style="width:90px; height:90px; object-fit:cover; border-radius:50%; border:2px ;">
            </div>


        </div>

        @isset($header)
            <div class="mb-4">
                {{ $header }}
            </div>
        @endisset


        @if (session('success'))
            <div class="mb-4 flex items-center justify-between bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow-sm"
                dir="rtl">
                <span>{{ session('success') }}</span>

                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">
                    ✕
                </button>
            </div>
        @endif
        {{ $slot }}

    </div>

    <!-- 🔥 JS -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('closed');
            document.getElementById('content').classList.toggle('full');
        }
    </script>

</body>

</html>
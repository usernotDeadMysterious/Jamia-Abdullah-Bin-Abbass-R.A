<!DOCTYPE html>
<html lang="ur" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>طالب علم کی تصدیق | Verification</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Noto Nastaliq Urdu', serif;
            /* Premium dark background with a subtle glow effect */
            background-color: #0f172a;
            background-image:
                radial-gradient(at 0% 0%, rgba(30, 41, 59, 1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(15, 23, 42, 1) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* Fix for dashes making numbers backward in Urdu */
        .ltr-fix {
            direction: ltr;
            unicode-bidi: embed;
            display: inline-block;
            text-align: right;
            font-family: sans-serif;
            /* Best for numbers */
        }

        /* Smooth load animation */
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 antialiased">

    @php
        // Fetch image if it exists
        $image = $student->documents->where('type', 'image')->first();
    @endphp

    <div class="w-full max-w-sm fade-in-up">

        <div class="text-center mb-6">
            <h1 class="text-white text-2xl font-bold tracking-wide">جامعہ عبد اللہ بن عباسؓ</h1>
            <p class="text-slate-400 text-sm mt-1 font-sans tracking-widest">VERIFICATION PORTAL</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden ring-1 ring-white/10">

            <div class="h-28 bg-gradient-to-r from-slate-800 to-slate-700 relative">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 16px 16px;">
                </div>
            </div>

            <div class="relative -mt-16 flex justify-center">
                <div
                    class="h-32 w-32 rounded-full border-4 border-white shadow-lg bg-slate-100 flex items-center justify-center overflow-hidden z-10 relative">
                    @if($image)
                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="Student Photo"
                            class="h-full w-full object-cover">
                    @else
                        <svg class="h-16 w-16 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    @endif
                </div>

                <div class="absolute -bottom-3 z-20">
                    @if($student->status == 'active')
                        <span
                            class="bg-emerald-500 text-white text-xs px-4 py-1.5 rounded-full font-bold shadow-md ring-2 ring-white flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            فعال (Active)
                        </span>
                    @else
                        <span
                            class="bg-red-500 text-white text-xs px-4 py-1.5 rounded-full font-bold shadow-md ring-2 ring-white flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            غیر فعال (Inactive)
                        </span>
                    @endif
                </div>
            </div>

            <div class="px-6 pt-10 pb-6">

                <h2 class="text-center text-xl font-bold text-slate-800 mb-6">
                    {{ $student->full_name }}
                </h2>

                <div class="space-y-4 text-sm">

                    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                        <span class="text-slate-500">والد کا نام:</span>
                        <span class="font-semibold text-slate-800">{{ $student->father_name }}</span>
                    </div>

                    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                        <span class="text-slate-500">رجسٹریشن نمبر:</span>
                        <span
                            class="font-bold text-amber-600 ltr-fix bg-amber-50 px-2 py-0.5 rounded">{{ $student->registration_no }}</span>
                    </div>

                    <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                        <span class="text-slate-500">کلاس:</span>
                        <span class="font-semibold text-slate-800">{{ $student->class_level }}</span>
                    </div>

                    @if($student->cnic)
                        <div class="flex justify-between items-center pb-1">
                            <span class="text-slate-500">شناختی نمبر:</span>
                            <span class="font-semibold text-slate-800 ltr-fix">{{ $student->cnic }}</span>
                        </div>
                    @endif

                </div>

            </div>

            <div class="bg-slate-50 px-6 py-4 flex items-center justify-center gap-2 border-t border-slate-100">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                <span class="text-xs text-slate-500 font-sans tracking-wide">SECURE VERIFIED RECORD</span>
            </div>

        </div>

        <div class="mt-6 text-center">
            <button onclick="window.close()"
                class="text-slate-400 text-sm hover:text-white transition-colors duration-200">
                بند کریں (Close)
            </button>
        </div>

    </div>

</body>

</html>
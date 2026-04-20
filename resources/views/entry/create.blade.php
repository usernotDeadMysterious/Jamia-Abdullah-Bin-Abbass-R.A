<x-app-layout>



    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 700px; border-radius: 12px;">

            <h2 class="text-center mb-4">وصول درج کریں</h2>

            <form method="POST" action="/entry/store">
                @csrf

                {{-- 📅 Date --}}
                <div class="mb-3">
                    <label class="form-label">تاریخ</label>
                    <input type="date" name="date" class="form-control form-control-sm" required>
                </div>

                {{-- 👤 Name --}}
                <div class="mb-3">
                    <label class="form-label">نام</label>
                    <input type="text" name="name" class="form-control form-control-sm">
                </div>

                {{-- 🧾 Receipt --}}
                <div class="mb-3">
                    <label class="form-label">رسید نمبر</label>
                    <input type="text" name="receipt_no" class="form-control form-control-sm">
                </div>

                {{-- 📂 Type --}}
                <div class="mb-3">
                    <label class="form-label">قسم</label>
                    <select name="type" class="form-select form-select-sm">
                        <option value="صدقہ">صدقہ</option>
                        <option value="زکوٰۃ">زکوٰۃ</option>
                        <option value="خرچ">خرچ</option>
                        <option value="اشیاء">اشیاء</option>
                    </select>
                </div>

                {{-- 💰 Amount --}}
                <div class="mb-3">
                    <label class="form-label">رقم</label>
                    <input type="number" name="amount" class="form-control form-control-sm">
                </div>

                {{-- 📝 Description --}}
                <div class="mb-3">
                    <label class="form-label">تفصیل</label>
                    <textarea name="description" class="form-control form-control-sm" rows="2"></textarea>
                </div>

                {{-- 🔘 Submit --}}
                <button type="submit" class="btn btn-primary w-100 rounded-pill">
                    محفوظ کریں
                </button>

            </form>
        </div>
    </div>

</x-app-layout>
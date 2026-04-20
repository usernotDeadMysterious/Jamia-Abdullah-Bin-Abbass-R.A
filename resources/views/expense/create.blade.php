<x-app-layout>



    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 700px; border-radius: 12px;">

            <h5 class="text-center mb-4">خرچ درج کریں</h5>

            <form method="POST" action="{{ url('/expense/store') }}">
                @csrf

                {{-- 📅 Date --}}
                <div class="mb-3">
                    <label class="form-label">تاریخ</label>
                    <input type="date" name="date" class="form-control form-control-sm" required>
                </div>

                {{-- 🏷️ Title --}}
                <div class="mb-3">
                    <label class="form-label">عنوان</label>
                    <input type="text" name="title" class="form-control form-control-sm" placeholder="مثلاً: بجلی بل"
                        required>
                </div>

                {{-- 👤 Given To --}}
                <div class="mb-3">
                    <label class="form-label">کس کو دیا</label>
                    <input type="text" name="given_to" class="form-control form-control-sm" required>
                </div>

                {{-- 📂 Category --}}
                <div class="mb-3">
                    <label class="form-label">کیٹیگری</label>
                    <select name="category" class="form-select form-select-sm">
                        <option value="تنخواہ">تنخواہ</option>
                        <option value="کھانا">کھانا</option>
                        <option value="بل">بل</option>
                        <option value="مرمت">مرمت</option>
                        <option value="دیگر">دیگر</option>
                    </select>
                </div>

                {{-- 💰 Amount --}}
                <div class="mb-3">
                    <label class="form-label">رقم</label>
                    <input type="number" name="amount" class="form-control form-control-sm" required>
                </div>

                {{-- 📝 Description --}}
                <div class="mb-3">
                    <label class="form-label">تفصیل</label>
                    <textarea name="description" class="form-control form-control-sm" rows="2"></textarea>
                </div>

                {{-- 🔘 Submit --}}
                <button type="submit" class="btn btn-danger w-100 rounded-pill">
                    محفوظ کریں
                </button>

            </form>
        </div>
    </div>

</x-app-layout>
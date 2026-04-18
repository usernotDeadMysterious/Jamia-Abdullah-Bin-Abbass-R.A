<x-app-layout>

    <h2 class="text-center mb-4">خرچ درج کریں</h2>

    {{-- ✅ Success Message --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="POST" action="{{ url('/expense/store') }}">
                @csrf

                {{-- 📅 Date --}}
                <div class="mb-3">
                    <label>تاریخ</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                {{-- 🏷️ Title --}}
                <div class="mb-3">
                    <label>عنوان (مثلاً: بجلی بل)</label>
                    <input type="text" name="title" class="form-control">
                </div>

                {{-- 👤 Given To --}}
                <div class="mb-3">
                    <label>کس کو دیا</label>
                    <input type="text" name="given_to" class="form-control">
                </div>

                {{-- 📂 Category --}}
                <div class="mb-3">
                    <label>کیٹیگری</label>
                    <select name="category" class="form-control">
                        <option value="تنخواہ">تنخواہ</option>
                        <option value="کھانا">کھانا</option>
                        <option value="بل">بل</option>
                        <option value="مرمت">مرمت</option>
                        <option value="دیگر">دیگر</option>
                    </select>
                </div>

                {{-- 💰 Amount --}}
                <div class="mb-3">
                    <label>رقم</label>
                    <input type="number" name="amount" class="form-control" required>
                </div>

                {{-- 📝 Description --}}
                <div class="mb-3">
                    <label>تفصیل</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                {{-- 🔘 Submit --}}
                <button type="submit" class="btn btn-danger w-100">
                    محفوظ کریں
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
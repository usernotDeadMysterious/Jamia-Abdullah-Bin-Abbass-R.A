<x-app-layout>

    <h2 class="text-center mb-4">رجسٹر اندراج کریں</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="POST" action="/entry/store">
                @csrf

                <div class="mb-3">
                    <label>تاریخ</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>نام</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label>رسید نمبر</label>
                    <input type="text" name="receipt_no" class="form-control">
                </div>



                <div class="mb-3">
                    <label>قسم</label>
                    <select name="type" class="form-control  pr-10 ">
                        <option class="ml-3" value="صدقہ">صدقہ</option>
                        <option value="زکوٰۃ">زکوٰۃ</option>
                        <option value="خرچ">خرچ</option>
                        <option value="اشیاء">اشیاء</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>رقم</label>
                    <input type="number" name="amount" class="form-control">
                </div>

                <div class="mb-3">
                    <label>تفصیل</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    محفوظ کریں
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
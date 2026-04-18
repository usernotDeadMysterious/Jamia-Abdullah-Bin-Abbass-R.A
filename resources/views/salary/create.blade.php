<x-app-layout>

    <h2 class="text-center mb-4">رجسٹر ادائیگی تنخواہ</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="POST" action="/salary/store">
                @csrf

                <div class="mb-3">
                    <label>نام</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>عہدہ</label>
                    <input type="text" name="designation" class="form-control">
                </div>

                <div class="mb-3">
                    <label>دن</label>
                    <input type="number" name="days" class="form-control">
                </div>

                <div class="mb-3">
                    <label>شرح</label>
                    <input type="number" name="rate" class="form-control">
                </div>

                <div class="mb-3">
                    <label>الاونس</label>
                    <input type="number" name="allowance" class="form-control" value="0">
                </div>

                <div class="mb-3">
                    <label>پیشگی</label>
                    <input type="number" name="advance" class="form-control" value="0">
                </div>

                <div class="mb-3">
                    <label>مہینہ</label>
                    <input type="number" name="month" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>سال</label>
                    <input type="number" name="year" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    محفوظ کریں
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
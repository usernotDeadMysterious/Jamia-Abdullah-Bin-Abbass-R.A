<x-app-layout>
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Noto Nastaliq Urdu', serif;
        }
    </style>
    <h2 class="text-center mb-4">صدقہ / زکوٰۃ درج کریں</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="POST" action="/sadqa/store">
                @csrf

                <div class="mb-3">
                    <label>قسم</label>
                    <select name="type" class="form-control">
                        <option value="صدقہ">صدقہ</option>
                        <option value="زکوٰۃ">زکوٰۃ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>رقم</label>
                    <input type="number" name="amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>دینے والا</label>
                    <input type="text" name="donor" class="form-control">
                </div>

                <div class="mb-3">
                    <label>تاریخ</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    محفوظ کریں
                </button>

            </form>

        </div>
    </div>

</x-app-layout>
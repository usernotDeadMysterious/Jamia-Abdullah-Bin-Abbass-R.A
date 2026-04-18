<x-app-layout>

    <h3 class="mb-4">ڈیش بورڈ</h3>

    <div class="row">

        <div class="col-md-3">
            <div class="card bg-success text-white p-3">
                <h5>کل آمدن</h5>
                <h3>{{ $totalIncome }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-danger text-white p-3">
                <h5>کل اخراجات</h5>
                <h3>{{ $totalExpense }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-primary text-white p-3">
                <h5>کل صدقات</h5>
                <h3>{{ $totalSadqa }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-dark p-3">
                <h5>کل تنخواہ</h5>
                <h3>{{ $totalSalary }}</h3>
            </div>
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-dark text-white p-3">
                <h5>بقیہ رقم</h5>
                <h2>{{ $balance }}</h2>
            </div>
        </div>
    </div>

</x-app-layout>
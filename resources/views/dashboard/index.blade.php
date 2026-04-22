<x-app-layout>

    <div class="p-4 space-y-6">

        {{-- 🔝 HEADER --}}
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">ڈیش بورڈ</h2>

            <div class="flex gap-2">
                <a href="/entry/create" class="px-4 py-2 bg-green-600 text-white rounded-xl text-sm">+ آمدن</a>
                <a href="/expense/create" class="px-4 py-2 bg-red-600 text-white rounded-xl text-sm">+ خرچ</a>
            </div>
        </div>

        {{-- 💰 INCOME --}}
        <div>
            <h3 class="text-sm text-gray-500 mb-2">آمدن</h3>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                @foreach([
                        ['label' => 'آج', 'value' => $incomeToday],
                        ['label' => 'ہفتہ', 'value' => $incomeWeek],
                        ['label' => 'مہینہ', 'value' => $incomeMonth],
                        ['label' => 'سال', 'value' => $incomeYear],
                    ] as $item)

                      <div   class="bg-white rounded-2xl shadow p-4">
                        <p class="text-xs text-gray-400">{{ $item['label'] }}</p>
                    <h3 class="text-xl font-bold text-green-600">
                            {{ number_format($item['value']) }}
                    </h3>
                        <p class="text-xs text-gray-500 mt-1">آمدن</p>
                    </div>

                @endforeach
    
            </div>
    </div>
   
     {{-- 💸 EXPENSE --}}
      <div>
          <h3 class="text-sm text-gray-500 mb-2">اخراجات</h3>
 
               <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                  @foreach([
                        ['label' => 'آج', 'value' => $expenseToday],
                        ['label' => 'ہفتہ', 'value' => $expenseWeek],
                        ['label' => 'مہینہ', 'value' => $expenseMonth],
                        ['label' => 'سال', 'value' => $expenseYear],
                    ] as $item)

                    <div class="bg-white rounded-2xl shadow p-4">
                        <p class="text-xs text-gray-400">{{ $item['label'] }}</p>
                    <h3 class="text-xl font-bold text-red-600">
                            {{ number_format($item['value']) }}
                        </h3>
                    <p class="text-xs text-gray-500 mt-1">اخراجات</p>
                    </div>

                   @endforeach

              </div>
        </div>
   
       {{-- 🧾 SALARY + BALANCE --}}
       <div  class="grid grid-cols-1 md:grid-cols-2 gap-4">
   
           {{--   SALARY --}}
            <div class="bg-white rounded-2xl shadow p-6">
            <p c    lass="text-sm text-gray-400">ماہانہ تنخواہ</p>
                <h2 class="text-2xl font-bold text-yellow-600 mt-2">
                    {{ number_format($salaryMonth) }}
            </h2>
            </div>

            {{-- BALANCE --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-sm text-gray-400">بقیہ رقم</p>
            <h2 class="text-2xl font-bold text-gray-800 mt-2">
                    {{ number_format($balance) }}
                </h2>
        </div>
    
    </div>

        {{-- 📈 TREND --}}
        <div class="bg-white rounded-2xl shadow p-6">
        <h3 class="text-sm text-gray-500 mb-4">گزشتہ 7 دن کا رجحان</h3>
    
            <canvas id="trendChart" height="100"></canvas>
    </div>

    {{-- 📈 MONTHLY TREND --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="text-sm text-gray-500 mb-4">گزشتہ 30 دن کا رجحان</h3>

            <canvas id="monthlyChart" height="100"></canvas>
        </div>
   
   </div>
 
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const trendData = @json($trend);

    const labels = trendData.map(t => t.date);
    const income = trendData.map(t => t.income);
    const expense = trendData.map(t => t.expense);

    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'آمدن',
                    data: income,
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'اخراجات',
                    data: expense,
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220,38,38,0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    const monthlyData = @json($monthlyTrend);

    const mLabels = monthlyData.map(t => t.date);
    const mIncome = monthlyData.map(t => t.income);
    const mExpense = monthlyData.map(t => t.expense);

    new Chart(document.getElementById('monthlyChart'), {
        type: 'line',
        data: {
            labels: mLabels,
            datasets: [
                {
                    label: 'آمدن',
                    data: mIncome,
                    borderColor: '#16a34a',
                    backgroundColor: 'rgba(22,163,74,0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'اخراجات',
                    data: mExpense,
                    borderColor: '#dc2626',
                    backgroundColor: 'rgba(220,38,38,0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxTicksLimit: 10   // 🔥 important (avoid crowd)
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</x-app-layout>
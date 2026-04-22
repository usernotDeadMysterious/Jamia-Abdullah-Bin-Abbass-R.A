<x-app-layout>

    <div class="container" dir="rtl">

        <h2 class="mb-4 text-center">آمد رپورٹ</h2>

        {{-- 🔍 Filters --}}
        <form method="GET" class="row g-2 mb-4">

            <div class="col-md-3">
                <label>سے</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label>تک</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>

            <div class="col-md-3">
                <label>موڈ</label>
                <select name="mode" class="form-control">
                    <option value="both" {{ request('mode', 'both') == 'both' ? 'selected' : '' }}>سب (Cash + Items)
                    </option>
                    <option value="cash" {{ request('mode') == 'cash' ? 'selected' : '' }}>صرف رقم</option>
                    <option value="items" {{ request('mode') == 'items' ? 'selected' : '' }}>صرف عطیات</option>
                </select>
            </div>

            <div class="d-flex gap-2 mb-3">

                {{-- 👁️ VIEW --}}
                <a href="{{ url('/reports/income/pdf-browser') . '?' . http_build_query(request()->all()) }}"
                    target="_blank" class="btn btn-success">
                    👁️ دیکھیں
                </a>

                {{-- ⬇️ DOWNLOAD --}}
                <a href="{{ url('/reports/income/pdf-browser') . '?' . http_build_query(array_merge(request()->all(), ['download' => 1])) }}"
                    target="_blank" class="btn btn-dark">
                    ⬇️ ڈاؤن لوڈ
                </a>

            </div>

        </form>



        <div class="row mb-3 text-center">

            <div class="col-md-6">
                <div class="card bg-success text-white p-3">
                    <h5>کل رقم</h5>
                    <h4>{{ number_format($totalCash) }}</h4>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-info text-white p-3">
                    <h5>کل عطیات (اشیاء)</h5>
                    <h4>{{ $totalItems }}</h4>
                </div>
            </div>

        </div>
        {{-- 📊 Table --}}
        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-bordered text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>تاریخ</th>
                            <th>نام</th>
                            <th>رسید</th>
                            <th>قسم</th>
                            <th>رقم</th>
                            <th>تفصیل</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($entries as $entry)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $entry->date }}</td>
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->receipt_no }}</td>
                                <td>{{ $entry->type }}</td>
                                <td>
                                    @if(($entry->amount ?? 0) > 0)
                                        <span class="text-success fw-bold">
                                            {{ number_format($entry->amount) }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">Item</span>
                                    @endif
                                </td>
                                <td>{{ $entry->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">کوئی ڈیٹا موجود نہیں</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>

</x-app-layout>
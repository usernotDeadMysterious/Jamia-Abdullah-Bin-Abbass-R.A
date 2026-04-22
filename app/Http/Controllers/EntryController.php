<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

use Spatie\Browsershot\Browsershot;

class EntryController extends Controller
{
    public function create()
    {
        return view('entry.create');
    }

    public function store(Request $request)
    {
        $entry = new Entry();

        $entry->date = $request->date;
        $entry->name = $request->name;
        $entry->receipt_no = $request->receipt_no;
        $entry->amount = $request->amount;
        $entry->type = $request->type;
        $entry->description = $request->description;

        $entry->save();

        return back()->with('success', 'اندراج محفوظ ہوگیا');
    }

    public function index(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $search = $request->search;
        $from = $request->from;
        $to = $request->to;

        $query = Entry::query();

        // ✅ DATE RANGE (PRIORITY)
        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('date', '>=', $from);
        } elseif ($to) {
            $query->whereDate('date', '<=', $to);
        }
        // ✅ FALLBACK (month/year)
        elseif ($month && $year) {
            $query->whereMonth('date', $month)
                ->whereYear('date', $year);
        }

        // 🔍 Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('receipt_no', 'like', "%$search%")
                    ->orWhere('type', 'like', "%$search%");
            });
        }

        $entries = $query->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('entry.index', compact(
            'entries',
            'month',
            'year',
            'search',
            'from',
            'to'
        ));
    }

    public function report(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $mode = $request->mode ?? 'both'; // cash / items / both

        $query = Entry::query();

        // 📅 Date range
        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        }

        // 💰 Modes
        if ($mode === 'cash') {
            $query->where('amount', '>', 0);
        }

        if ($mode === 'items') {
            $query->where(function ($q) {
                $q->whereNull('amount')
                    ->orWhere('amount', 0);
            });
        }

        $entries = $query->orderBy('date', 'desc')->get();

        // 💰 Total cash only
        $totalCash = (clone $query)->where('amount', '>', 0)->sum('amount');

        // 📦 Count items
        $totalItems = (clone $query)->where(function ($q) {
            $q->whereNull('amount')->orWhere('amount', 0);
        })->count();

        return view('reports.income', compact(
            'entries',
            'totalCash',
            'totalItems',
            'from',
            'to',
            'mode'
        ));
    }

    public function reportPdfBrowser(Request $request)
    {
        // ... (Your existing query logic) ...
        $from = $request->from;
        $to = $request->to;
        $mode = $request->mode ?? 'both';
        $query = Entry::query();
        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        }
        if ($mode === 'cash') {
            $query->where('amount', '>', 0);
        }
        if ($mode === 'items') {
            $query->where(function ($q) {
                $q->whereNull('amount')->orWhere('amount', 0);
            });
        }
        $entries = $query->orderBy('date', 'desc')->get();
        $totalCash = (clone $query)->where('amount', '>', 0)->sum('amount');
        $totalItems = (clone $query)->where(function ($q) {
            $q->whereNull('amount')->orWhere('amount', 0);
        })->count();

        $html = view('reports.income-pdf', compact('entries', 'totalCash', 'totalItems', 'from', 'to', 'mode'))->render();

        // 1. USE A FILE URL INSTEAD OF BASE64
        // This makes the header string tiny so Windows doesn't crash.
        $logoUrl = url('logo-6.png');

        $header = '
<div style="width:100%; font-size:10px; padding:5px 20px; direction:rtl; -webkit-print-color-adjust: exact;">
    <div style="display:flex; justify-content:space-around; align-items:center;">
        <div style="text-align:center;">
            <h2 style="font-size:20px; margin:10px; padding:0;">جامعہ عبد اللہ بن عباس رضی اللہ عنہ</h2>
            <p style="font-size:14px; margin:5px 0;">یونیورسٹی روڈ، تہکال پایاں، پشاور</p>
            <span>0321-9116027</span>
        </div>
        
    </div>
    <span style="font-size:14px; padding-right:25px; font-weight:bold;">تفصیل آمد</span>
    <div style="text-align:center; margin-top:5px; margin-bottom:15px;">
   آمد رپورٹ | مدت: ' . ($from ? $from : 'شروع') . ' سے ' . ($to ? $to : 'آج تک') . ' </div>
    
</div>';

        $footer = '
<div style="width:100%; font-size:10px; padding:5px 20px; direction:rtl;">
    
    <!-- Signature / Stamp Section -->
    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
        
        <div style="text-align:center; width:30%;">
            ______________________<br>
            دستخط (Signature)
        </div>

        <div style="text-align:center; width:30%;">
            ______________________<br>
            مہر (Stamp)
        </div>

    </div>

    <!-- Footer Bottom Row -->
    <div style="display:flex; justify-content:space-between; border-top:1px solid #ccc; padding-top:5px;">
        <div>یہ رپورٹ کمپیوٹر کے ذریعے تیار کی گئی ہے</div>
        <div style="text-align:center;">
            صفحہ <span class="pageNumber"></span> / <span class="totalPages"></span>
        </div>
    </div>

</div>';

        // 2. USE THE CORRECT CHROME ARGUMENTS
        return response(
            Browsershot::html($html)
                ->format('A4')
                ->showBackground()
                ->margins(35, 10, 30, 10)
                ->useTemporaryOptionsFile()
                ->showBrowserHeaderAndFooter()
                ->headerHtml($header)
                ->footerHtml($footer)
                ->setOption('args', [
                    '--no-sandbox',
                    '--disable-web-security',
                    '--allow-running-insecure-content'
                ])
                ->pdf()
        )->header('Content-Type', 'application/pdf');
    }
}




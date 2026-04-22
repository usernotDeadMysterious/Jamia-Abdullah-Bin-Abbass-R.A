<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
class ExpenseController extends Controller
{
    // 🔹 Show form
    public function create()
    {
        return view('expense.create');
    }

    // 🔹 Store expense
    public function store(Request $request)
    {
        $expense = new Expense();

        $expense->date = $request->date;
        $expense->title = $request->title;
        $expense->given_to = $request->given_to;
        $expense->category = $request->category;
        $expense->amount = $request->amount;
        $expense->description = $request->description;

        $expense->save();

        return back()->with('success', 'خرچ محفوظ ہوگیا');
    }

    // 🔹 List / Report
    public function index(Request $request)
    {
        $search = $request->search;
        $from = $request->from;
        $to = $request->to;

        $query = Expense::query();

        // ✅ DATE RANGE (PRIORITY)
        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('date', '>=', $from);
        } elseif ($to) {
            $query->whereDate('date', '<=', $to);
        }

        // 🔍 Search
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('given_to', 'like', "%$search%")
                    ->orWhere('category', 'like', "%$search%");
            });
        }

        $expenses = $query->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        $totalExpense = (clone $query)->sum('amount');

        return view('expense.index', compact(
            'expenses',
            'totalExpense',
            'search',
            'from',
            'to'
        ));
    }

    public function report(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = Expense::query();

        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        }

        $expenses = $query->orderBy('date', 'desc')->get();

        $totalExpense = (clone $query)->sum('amount');

        return view('reports.expense', compact(
            'expenses',
            'totalExpense',
            'from',
            'to'
        ));
    }

    public function reportPdfBrowser(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = Expense::query();

        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        }

        $expenses = $query->orderBy('date', 'desc')->get();
        $totalExpense = (clone $query)->sum('amount');

        $html = view('reports.expense-pdf', compact(
            'expenses',
            'totalExpense',
            'from',
            'to'
        ))->render();

        // HEADER
        $header = '
<div style="width:100%; font-size:10px; padding:5px 20px; direction:rtl; -webkit-print-color-adjust: exact;">
    
    <div style="text-align:center;">
        <h2 style="font-size:20px; margin:10px;">جامعہ عبد اللہ بن عباس رضی اللہ عنہ</h2>
        <p style="font-size:14px; margin:5px 0;">یونیورسٹی روڈ، تہکال پایاں، پشاور</p>
        <span>0321-9116027</span>
    </div>

    <span style="font-size:14px; padding-right:25px; font-weight:bold;">تفصیل اخراجات</span>

    <div style="text-align:center; margin-top:5px; margin-bottom:15px;">
        خرچ رپورٹ | مدت: ' . ($from ? $from : 'شروع') . ' سے ' . ($to ? $to : 'آج تک') . '
    </div>

</div>';

        // FOOTER
        $footer = '
<div style="width:100%; font-size:10px; padding:5px 20px; direction:rtl;">
    
    <div style="display:flex; justify-content:space-between; margin-bottom:10px;">
        
        <div style="text-align:center; width:30%;">
            ______________________<br>
            دستخط
        </div>

        <div style="text-align:center; width:30%;">
            ______________________<br>
            مہر
        </div>

    </div>

    <div style="display:flex; justify-content:space-between; border-top:1px solid #ccc; padding-top:5px;">
        <div>یہ رپورٹ کمپیوٹر کے ذریعے تیار کی گئی ہے</div>
        <div>
            صفحہ <span class="pageNumber"></span> / <span class="totalPages"></span>
        </div>
    </div>

</div>';

        $pdf = Browsershot::html($html)
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
            ->pdf();

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header(
                'Content-Disposition',
                $request->has('download')
                ? 'attachment; filename="expense-report.pdf"'
                : 'inline; filename="expense-report.pdf"'
            );
    }

    public function salaries(Request $request)
    {
        $search = $request->search;
        $from = $request->from;
        $to = $request->to;

        $query = Expense::where('category', 'تنخواہ'); // ✅ IMPORTANT

        // 📅 DATE FILTER
        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('date', '>=', $from);
        } elseif ($to) {
            $query->whereDate('date', '<=', $to);
        }

        // 🔍 SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('given_to', 'like', "%$search%");
            });
        }

        $expenses = $query->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        $totalSalary = (clone $query)->sum('amount');

        return view('expense.salaries', compact(
            'expenses',
            'totalSalary',
            'search',
            'from',
            'to'
        ));
    }
    public function salaryPdfBrowser(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = Expense::where('category', 'تنخواہ'); // ✅ FIXED

        if ($from && $to) {
            $query->whereBetween('date', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('date', '>=', $from);
        } elseif ($to) {
            $query->whereDate('date', '<=', $to);
        }

        $expenses = $query->orderBy('date', 'desc')->get();
        $totalSalary = (clone $query)->sum('amount');

        $html = view('reports.salary-pdf', compact(
            'expenses',
            'totalSalary',
            'from',
            'to'
        ))->render();

        // ✅ HEADER
        $header = '
<div style="width:100%; font-size:10px; padding:5px 20px; direction:rtl; -webkit-print-color-adjust: exact;">
    <div style="display:flex; justify-content:space-around; align-items:center;">
        <div style="text-align:center;">
            <h2 style="font-size:20px; margin:10px; padding:0;">جامعہ عبد اللہ بن عباس رضی اللہ عنہ</h2>
            <p style="font-size:14px; margin:5px 0;">یونیورسٹی روڈ، تہکال پایاں، پشاور</p>
            <span>0321-9116027</span>
        </div>
        
    </div>
    <span style="font-size:14px; padding-right:25px; font-weight:bold;">تنخواہ رپورٹ</span>
    <div style="text-align:center; margin-top:5px; margin-bottom:15px;">
   تنخواہ رپورٹ | مدت: ' . ($from ? $from : 'شروع') . ' سے ' . ($to ? $to : 'آج تک') . ' </div>
    
</div>';

        // ✅ FOOTER
        $footer = '
<div style="width:100%; font-size:10px; padding:5px 20px; direction:rtl;">
    <div style="display:flex; justify-content:space-between;">
        <div>یہ رپورٹ کمپیوٹر کے ذریعے تیار کی گئی ہے</div>
        <div>صفحہ <span class="pageNumber"></span> / <span class="totalPages"></span></div>
    </div>
</div>';

        $pdf = Browsershot::html($html)
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
            ->pdf();

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header(
                'Content-Disposition',
                $request->has('download')
                ? 'attachment; filename="salary-report.pdf"'
                : 'inline; filename="salary-report.pdf"'
            );
    }

}
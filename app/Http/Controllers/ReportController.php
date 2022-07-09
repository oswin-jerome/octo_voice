<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceWithTaxResource;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Invoice;
use App\Models\Tax;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Svg\Tag\Rect;

class ReportController extends Controller
{

    public function report()
    {
        return Inertia::render("Reports/Reports");
    }
    public function taxes(Request $request)
    {
        $data = [];
        if ($request->has("taxes")) {
            $data = Invoice::whereHas("taxes", function ($query) use ($request) {
                $query->whereIn("tax_id", explode(",", $request->taxes));
            });
        }

        if (isset($request->from) && isset($request->to)) {
            $data = $data->whereDate("created_at", ">=", $request->from);
            $data = $data->whereDate("created_at", "<=", $request->to);
        }

        $data = $data->get();
        return Inertia::render("Reports/Tax", [
            "taxes" => Tax::all(),
            "data" => InvoiceWithTaxResource::collection($data),
            "from" => Carbon::now()->addDays(-15)->format('Y-m-d'),
            "to" => Carbon::now()->format('Y-m-d'),
        ]);
    }

    public function taxes_pdf(Request $request)
    {
        $data = Invoice::whereHas("taxes", function ($query) use ($request) {
            $query->whereIn("tax_id", explode(",", $request->taxes));
        })->get();
        $pdf = PDF::loadView('pdf.tax', [
            'data' => $data,
            "selectedTaxes" => Tax::whereIn("id", explode(",", $request->taxes))->get()
        ]);
        return $pdf->stream('taxes.pdf');
    }


    public function expenses()
    {
        return Inertia::render("Reports/Expenses");
    }
    public function expenses_pdf(Request $request)
    {
        if (isset($request->type)) {
            if (in_array($request->type, ['date', 'month', 'year'])) {

                $pdf = PDF::loadView('pdf.reports.expense_date', [
                    "expenses" => Expense::with("category")->get()->groupBy(function ($d) use ($request) {
                        if ($request->type == "date") {
                            return $d->created_at->format("d M Y ");
                        } else if ($request->type == "month") {
                            return $d->created_at->format("M Y ");
                        } else if ($request->type == "year") {
                            return $d->created_at->format("Y ");
                        }
                        return Carbon::parse($d->created_at)->format('M Y d');
                    })
                ]);
                return $pdf->stream('taxes.pdf');
            }
        }

        $pdf = PDF::loadView('pdf.reports.expense_category', [
            "categories" => ExpenseCategory::with("expenses")->get()
        ]);
        return $pdf->stream('taxes.pdf');
    }
}

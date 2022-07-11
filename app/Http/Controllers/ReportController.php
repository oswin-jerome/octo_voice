<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceWithTaxResource;
use App\Models\Customer;
use App\Models\Deliverable;
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
        // $data = [];
        // if ($request->has("taxes")) {
        //     $data = Invoice::whereHas("taxes", function ($query) use ($request) {
        //         $query->whereIn("tax_id", explode(",", $request->taxes));
        //     });
        // }

        // if (isset($request->from) && isset($request->to)) {
        //     $data = $data->whereDate("created_at", ">=", $request->from);
        //     $data = $data->whereDate("created_at", "<=", $request->to);
        // }

        // $data = $data->get();
        // return Inertia::render("Reports/Tax", [
        //     "taxes" => Tax::all(),
        //     "data" => InvoiceWithTaxResource::collection($data),
        //     "from" => Carbon::now()->addDays(-15)->format('Y-m-d'),
        //     "to" => Carbon::now()->format('Y-m-d'),
        // ]);

        return Inertia::render("Reports/TaxPdf", []);
    }

    public function taxes_pdf(Request $request)
    {

        if (isset($request->type)) {
            if (in_array($request->type, ['date', 'month', 'year'])) {
                $taxes = Tax::with("invoices");

                // if (isset($request->from) && isset($request->to)) {
                //     $taxes = $taxes->whereDate("created_at", ">=", $request->from);
                //     $taxes = $taxes->whereDate("created_at", "<=", $request->to);
                // }
                $invoices = Invoice::with("taxes");

                if (isset($request->from) && isset($request->to)) {
                    $invoices = $invoices->whereDate("created_at", ">=", $request->from);
                    $invoices = $invoices->whereDate("created_at", "<=", $request->to);
                }
                // dd($invoices->get()->groupBy(function ($d) use ($request) {
                //     if ($request->type == "date") {
                //         return $d->created_at->format("d M Y ");
                //     } else if ($request->type == "month") {
                //         return $d->created_at->format("M Y ");
                //     } else if ($request->type == "year") {
                //         return $d->created_at->format("Y ");
                //     }
                //     return Carbon::parse($d->created_at)->format('M Y d');
                // })['Jul 2022 ']->map((function ($d) {
                //     return $d->taxes;
                // }))->flatten());


                $pdf = PDF::loadView('pdf.reports.tax_date', [
                    "invoices" => $invoices->get()->groupBy(
                        function ($d) use ($request) {
                            if ($request->type == "date") {
                                return $d->created_at->format("d M Y ");
                            } else if ($request->type == "month") {
                                return $d->created_at->format("M Y ");
                            } else if ($request->type == "year") {
                                return $d->created_at->format("Y ");
                            }
                            return Carbon::parse($d->created_at)->format('M Y d');
                        }
                    ),
                    "taxes" => Tax::all(),

                    "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
                    "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
                ]);
                return $request->download == 'true' ? $pdf->download("expense_report.pdf") : $pdf->stream('taxes.pdf');
            }
        }


        $taxes = Tax::with(["invoices" => function ($d) use ($request) {
            $d->whereDate("invoices.created_at", ">=", $request->from);
            $d->whereDate("invoices.created_at", "<=", $request->to);
        }]);
        $pdf = PDF::loadView('pdf.reports.tax_tax', [
            "taxes" => $taxes->get(),
            "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
            "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
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
                $exp = Expense::with("category");

                if (isset($request->from) && isset($request->to)) {
                    $exp = $exp->whereDate("created_at", ">=", $request->from);
                    $exp = $exp->whereDate("created_at", "<=", $request->to);
                }
                $pdf = PDF::loadView('pdf.reports.expense_date', [
                    "expenses" => $exp->get()->groupBy(function ($d) use ($request) {
                        if ($request->type == "date") {
                            return $d->created_at->format("d M Y ");
                        } else if ($request->type == "month") {
                            return $d->created_at->format("M Y ");
                        } else if ($request->type == "year") {
                            return $d->created_at->format("Y ");
                        }
                        return Carbon::parse($d->created_at)->format('M Y d');
                    }),

                    "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
                    "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
                ]);
                return $request->download == 'true' ? $pdf->download("expense_report.pdf") : $pdf->stream('taxes.pdf');
            }
        }

        $exp_cat = ExpenseCategory::with('expenses');
        if (isset($request->from) && isset($request->to)) {
            $exp_cat = ExpenseCategory::with(["expenses" => function ($d) use ($request) {
                $d->whereDate("created_at", ">=", $request->from);
                $d->whereDate("created_at", "<=", $request->to);
            }]);
            // $exp_cat = $exp_cat->whereDate("created_at", ">=", $request->from);
            // $exp_cat = $exp_cat->whereDate("created_at", "<=", $request->to);
        }

        // dd(->get());
        $pdf = PDF::loadView('pdf.reports.expense_category', [
            "categories" => $exp_cat->get(),
            "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
            "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
        ]);
        return $request->download == 'true' ? $pdf->download("expense_report.pdf") : $pdf->stream('taxes.pdf');
    }

    public function sales()
    {
        return Inertia::render("Reports/Sales");
    }
    public function sales_pdf(Request $request)
    {

        if (isset($request->type)) {
            if (in_array($request->type, ['date', 'month', 'year'])) {
                $invoices = Invoice::with("customer");

                if (isset($request->from) && isset($request->to)) {
                    $invoices = $invoices->whereDate("created_at", ">=", $request->from);
                    $invoices = $invoices->whereDate("created_at", "<=", $request->to);
                }
                $pdf = PDF::loadView('pdf.reports.sales_date', [
                    "invoices" => $invoices->get()->groupBy(function ($d) use ($request) {
                        if ($request->type == "date") {
                            return $d->created_at->format("d M Y ");
                        } else if ($request->type == "month") {
                            return $d->created_at->format("M Y ");
                        } else if ($request->type == "year") {
                            return $d->created_at->format("Y ");
                        }
                        return Carbon::parse($d->created_at)->format('M Y d');
                    }),

                    "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
                    "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
                ]);
                return $request->download == 'true' ? $pdf->download("expense_report.pdf") : $pdf->stream('taxes.pdf');
            }
        }
        if (isset($request->type)) {
            if (in_array($request->type, ['deliverable'])) {
                $deliverables = Deliverable::whereHas("invoices", function ($d) use ($request) {
                    $d->whereDate("invoices.created_at", ">=", $request->from);
                    $d->whereDate("invoices.created_at", "<=", $request->to);
                })->with(["invoices" => function ($d) use ($request) {
                    // dd($d->deliverable);
                    $d->whereDate("invoices.created_at", ">=", $request->from);
                    $d->whereDate("invoices.created_at", "<=", $request->to);
                    $d->with(['deliverables']);
                }]);
                // if (isset($request->from) && isset($request->to)) {
                //     $deliverables = $deliverables->whereDate("created_at", ">=", $request->from);
                //     $deliverables = $deliverables->whereDate("created_at", "<=", $request->to);
                // }
                // dd($deliverables->get()[0]->invoices[0]->pivot);
                $pdf = PDF::loadView('pdf.reports.sales_deliverable', [

                    "deliverables" => $deliverables->get(),
                    "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
                    "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
                ]);
                return $request->download == 'true' ? $pdf->download("expense_report.pdf") : $pdf->stream('taxes.pdf');
            }
        }


        $pdf = PDF::loadView('pdf.reports.sales_customer', [
            "customers" => Customer::whereHas("invoices", function ($d) use ($request) {
                $d->whereDate("invoices.created_at", ">=", $request->from);
                $d->whereDate("invoices.created_at", "<=", $request->to);
            })->with("invoices", function ($d) use ($request) {
                $d->whereDate("invoices.created_at", ">=", $request->from);
                $d->whereDate("invoices.created_at", "<=", $request->to);
            })->get(),
            "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
            "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
        ]);
        return $request->download == 'true' ? $pdf->download("expense_report.pdf") : $pdf->stream('taxes.pdf');
    }

    public function profit()
    {
        return Inertia::render("Reports/Profit");
    }
    public function profit_pdf(Request $request)
    {
        // dd(Invoice::find(1)->sub_total_with_discount);
        $pdf = PDF::loadView('pdf.reports.profit', [
            "income" => Invoice::whereDate("invoices.created_at", ">=", $request->from)->whereDate('created_at', "<=", $request->to)->get()->sum('sub_total_with_discount'),
            "expense" => Expense::whereDate("expenses.created_at", ">=", $request->from)->whereDate('expenses.created_at', "<=", $request->to)->sum("amount"),
            "from" => Carbon::parse($request->from)->format('M d Y') ?? "",
            "to" => Carbon::parse($request->to)->format('M d Y') ?? ""
        ]);
        return $request->download == 'true' ? $pdf->download("expense_report.pdf") : $pdf->stream('taxes.pdf');
    }
}

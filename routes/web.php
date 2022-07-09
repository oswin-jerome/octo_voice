<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $todaysInvoiceCount = Invoice::whereDate('created_at', Carbon::today())->where("status", "<>", "cancelled")->count();
    $todaysPayment = Payment::whereDate('created_at', Carbon::today())->sum("amount");
    $taxInvoice = Tax::find(2)->invoices;
    $invoices = Invoice::whereHas("taxes", function ($query) {
        $query->where("tax_id", 2);
    })->whereDate('created_at', Carbon::today())->where("status", "<>", "cancelled")->get();
    $taxAmount = 0;
    foreach ($invoices as $key => $value) {
        $taxAmount += $value->getParticularTaxAmount(Tax::find(2));
    }
    return Inertia::render('Dashboard', [
        "invoice_count" => $todaysInvoiceCount,
        "invoice_sum" => Invoice::whereDate('created_at', Carbon::today())->where("status", "<>", "cancelled")->get()->sum("total"),
        "todays_payment" => $todaysPayment,
        "tax" => [
            "Tax" => Tax::find(2),
            "taxAmount" => $taxAmount
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/test', function () {
    return view('mail.estimate', [
        "customer" => Customer::find(1),
        "estimate" => Estimate::findOrFail(1)
    ]);
})->middleware(['auth', 'verified'])->name('test');

Route::middleware("auth")->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('deliverables', DeliverableController::class);
    Route::resource('estimates', EstimateController::class);
    Route::get('estimates/{estimate}/pdf', [EstimateController::class, "pdf"])->name("estimates.pdf");
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, "pdf"])->name("invoices.pdf");
    Route::put('invoices/{invoice}/status/{status}', [InvoiceController::class, "changeStatus"])->name("invoices.changestatus");

    Route::get('payments/{invoice}/create', [PaymentController::class, "create_with_invoice"])->name("payments.create_invoice");
    Route::resource('payments', PaymentController::class);
    Route::get('payments/{payment}/pdf', [PaymentController::class, "pdf"])->name("payments.pdf");


    Route::resource('expenses', ExpenseController::class);


    // Payments
    Route::get('reports', [ReportController::class, "report"])->name("reports.index");
    Route::get('reports/taxes', [ReportController::class, "taxes"])->name("reports.taxes");
    Route::get('reports/taxes/pdf', [ReportController::class, "taxes_pdf"])->name("reports.taxes_pdf");

    Route::get('reports/expenses/pdf', [ReportController::class, "expenses_pdf"])->name("reports.expenses_pdf");
    Route::get('reports/expenses', [ReportController::class, "expenses"])->name("reports.expenses");
});

require __DIR__ . '/auth.php';

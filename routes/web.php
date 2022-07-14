<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
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
    return Redirect::route('dashboard');
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
        "invoice_sum" => number_format(Invoice::whereDate('created_at', Carbon::today())->where("status", "<>", "cancelled")->get()->sum("total"), 2),
        "todays_payment" => number_format($todaysPayment, 2),
        "tax" => [
            "Tax" => Tax::find(2),
            "taxAmount" => number_format($taxAmount, 2)
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
    Route::resource('settings', SettingController::class);

    Route::prefix('assets')->group(function () {
        Route::get('/checkout/create', [AssetController::class, "create_checkout"])->name("assets.create_checkout");
        Route::get('/checkin/create', [AssetController::class, "create_checkin"])->name("assets.create_checkin");
        Route::post('/checkout', [AssetController::class, "checkout"])->name("assets.checkout");
        Route::post('/checkin', [AssetController::class, "checkin"])->name("assets.checkin");
    });
    Route::resource('assets', AssetController::class);



    // Payments
    Route::get('reports', [ReportController::class, "report"])->name("reports.index");
    Route::get('reports/taxes', [ReportController::class, "taxes"])->name("reports.taxes");
    Route::get('reports/taxes/pdf', [ReportController::class, "taxes_pdf"])->name("reports.taxes_pdf");

    Route::get('reports/expenses/pdf', [ReportController::class, "expenses_pdf"])->name("reports.expenses_pdf");
    Route::get('reports/expenses', [ReportController::class, "expenses"])->name("reports.expenses");

    Route::get('reports/sales/pdf', [ReportController::class, "sales_pdf"])->name("reports.sales_pdf");
    Route::get('reports/sales', [ReportController::class, "sales"])->name("reports.sales");

    Route::get('reports/profit/pdf', [ReportController::class, "profit_pdf"])->name("reports.profit_pdf");
    Route::get('reports/profit', [ReportController::class, "profit"])->name("reports.profit");
});

require __DIR__ . '/auth.php';

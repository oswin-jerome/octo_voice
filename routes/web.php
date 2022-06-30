<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliverableController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\InvoiceController;
use App\Models\Customer;
use App\Models\Estimate;
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
    return Inertia::render('Dashboard');
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
});

require __DIR__ . '/auth.php';

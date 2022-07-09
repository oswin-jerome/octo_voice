<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Http\Resources\InvoiceListResource;
use App\Http\Resources\PaymentListResource;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade as PDF;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentListResource::collection(Payment::orderBy("created_at", "desc")->paginate(5));
        return Inertia::render('Payments/Index', [
            'payments' => $payments,
        ]);
    }

    public function pdf(Payment $payment)
    {
        $pdf = PDF::loadView('pdf.payment', [
            "customer" => $payment->paymentable->customer,
            "payment" => $payment
        ]);
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function create_with_invoice(Invoice $invoice)
    {
        return Inertia::render('Payments/CreateFromInvoice', [
            "invoice" => new InvoiceListResource($invoice),
            "customers" => Customer::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);
        $payment = $invoice->payments()->create($request->safe()->except(['invoice_id']));
        $invoice = Invoice::findOrFail($request->invoice_id);
        if ($invoice->balance <= 0) {
            $invoice->status = 'paid';
            $invoice->save();
        } else {
            $invoice->status = 'partially_paid';
            $invoice->save();
        }

        return redirect()->route('payments.show', $payment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return Inertia::render('Payments/pdf', [
            "payment" => $payment,
            "payment_id" => $payment->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaymentRequest  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

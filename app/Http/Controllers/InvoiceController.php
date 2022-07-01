<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceListResource;
use App\Mail\InvoiceMail;
use App\Models\Customer;
use App\Models\Deliverable;
use App\Models\Invoice;
use App\Models\Tax;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Invoices/Index', [
            "invoices" => InvoiceListResource::collection(Invoice::searchable()->filterable()->with(["deliverables", "customer"])->paginate(10))
        ]);
    }

    public function pdf(Invoice $invoice)
    {
        $pdf = PDF::loadView('pdf.invoice', [
            "customer" => $invoice->customer,
            "invoice" => $invoice
        ]);
        return $pdf->stream();
    }

    public function changeStatus(Invoice $invoice,  $status)
    {
        $invoice->status = $status;
        $invoice->save();
        return redirect()->route("invoices.show", $invoice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Invoices/Create', [
            'deliverables' => Deliverable::all(),
            "customers" => Customer::all(),
            "taxes" => Tax::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $invoice = Invoice::create($request->except(["deliverables", "taxes"]));
        $invoice->deliverables()->sync($request->input('deliverables'));

        // $tax = Tax::first();
        // $invoice->taxes()->save($tax);

        // TODO: try this below step
        $invoice->taxes()->sync($request->input('taxes'));

        if ($invoice->customer->email) {
            Mail::to($invoice->customer->email)->send(new InvoiceMail($invoice));
        }
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return Inertia::render('Invoices/pdf', [
            "invoice" => $invoice,
            "invoice_id" => $invoice->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}

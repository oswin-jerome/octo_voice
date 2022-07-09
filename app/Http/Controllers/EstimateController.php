<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstimateRequest;
use App\Http\Requests\UpdateEstimateRequest;
use App\Http\Resources\EstimateListResource;
use App\Mail\EstimateMail;
use App\Models\Customer;
use App\Models\Deliverable;
use App\Models\Estimate;
use App\Models\Tax;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Estimates/Index', [
            "estimates" => EstimateListResource::collection(Estimate::searchable()->filterable("created_at", "desc")->with(["deliverables", "customer"])->paginate(10))
        ]);
    }

    public function pdf(Estimate $estimate)
    {
        $pdf = PDF::loadView('pdf.estimate', [
            "customer" => $estimate->customer,
            "estimate" => $estimate,

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
        return Inertia::render('Estimates/Create', [
            'deliverables' => Deliverable::all(),
            "customers" => Customer::all(),
            "taxes" => Tax::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEstimateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstimateRequest $request)
    {
        $estimate = Estimate::create($request->except(["deliverables", 'taxes']));
        // dd($estimate);
        $estimate->deliverables()->sync($request->input('deliverables'));
        $estimate->taxes()->sync($request->input('taxes'));

        // dd($estimate->customer);
        if ($estimate->customer->email) {
            Mail::to($estimate->customer->email)->send(new EstimateMail($estimate));
        }
        return redirect()->route('estimates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function show(Estimate $estimate)
    {
        return Inertia::render('Estimates/pdf', [
            "estimate" => $estimate,
            "estimate_id" => $estimate->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function edit(Estimate $estimate)
    {
        // dd();
        return Inertia::render('Estimates/Edit', [
            "estimate" => Estimate::with(['deliverables', 'taxes'])->where('id', $estimate->id)->first(),
            'deliverables' => Deliverable::all(),
            "customers" => Customer::all(),
            "taxes" => Tax::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEstimateRequest  $request
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstimateRequest $request, Estimate $estimate)
    {
        $estimate->update($request->except(["deliverables", 'taxes']));
        $estimate->deliverables()->sync($request->input('deliverables'));
        $estimate->taxes()->sync($request->input('taxes'));

        // dd($estimate->customer);
        if ($estimate->customer->email) {
            Mail::to($estimate->customer->email)->send(new EstimateMail($estimate));
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estimate  $estimate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estimate $estimate)
    {
        //
    }
}

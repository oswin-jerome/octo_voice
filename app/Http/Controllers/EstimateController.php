<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstimateRequest;
use App\Http\Requests\UpdateEstimateRequest;
use App\Http\Resources\EstimateListResource;
use App\Mail\EstimateMail;
use App\Models\Customer;
use App\Models\Deliverable;
use App\Models\Estimate;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
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
            "estimate" => $estimate
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
            "customers" => Customer::all()
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
        $estimate = Estimate::create($request->except("deliverables"));
        // dd($estimate);
        $estimate->deliverables()->sync($request->input('deliverables'));
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
        //
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
        //
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

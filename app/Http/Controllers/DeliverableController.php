<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliverableRequest;
use App\Http\Requests\UpdateDeliverableRequest;
use App\Models\Deliverable;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Activitylog\Contracts\Activity;

class DeliverableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Deliverables/Index', [
            'deliverables' => Deliverable::searchable()->filterable()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Deliverables/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDeliverableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliverableRequest $request)
    {
        $deliverable = Deliverable::create($request->validated());
        return redirect()->route('deliverables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function show(Deliverable $deliverable)
    {
        return Inertia::render('Deliverables/Show', [
            'deliverables' => $deliverable
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function edit(Deliverable $deliverable)
    {
        return Inertia::render('Deliverables/Edit', [
            'deliverable' => $deliverable
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliverableRequest  $request
     * @param  \App\Models\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliverableRequest $request, Deliverable $deliverable)
    {
        $oldPrice = $deliverable->price;
        $deliverable->update($request->validated());
        if ($oldPrice != $deliverable->price) {
            activity("deliverable")->causedBy(auth()->user())->performedOn($deliverable)->event('price_update')->log("price updated from " . $oldPrice . " to " . $deliverable->price);
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deliverable  $deliverable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliverable $deliverable)
    {
        //
    }
}

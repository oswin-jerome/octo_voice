<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetTransactionRequest;
use App\Http\Requests\UpdateAssetTransactionRequest;
use App\Models\AssetTransaction;

class AssetTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAssetTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetTransaction  $assetTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(AssetTransaction $assetTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetTransaction  $assetTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetTransaction $assetTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAssetTransactionRequest  $request
     * @param  \App\Models\AssetTransaction  $assetTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssetTransactionRequest $request, AssetTransaction $assetTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetTransaction  $assetTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetTransaction $assetTransaction)
    {
        //
    }
}

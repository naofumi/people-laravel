<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\StoreTaggingRequest;
use App\Http\Requests\UpdateTaggingRequest;
use App\Models\Tagging;

class TaggingController extends Controller
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
     * @param  \App\Http\Requests\StoreTaggingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaggingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tagging  $tagging
     * @return \Illuminate\Http\Response
     */
    public function show(Tagging $tagging)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tagging  $tagging
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagging $tagging)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaggingRequest  $request
     * @param  \App\Models\Tagging  $tagging
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaggingRequest $request, Tagging $tagging)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tagging  $tagging
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tagging $tagging)
    {
        //
    }
}

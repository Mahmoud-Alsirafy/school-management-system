<?php

namespace App\Http\Controllers\ProcessingFees;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\ProcessingFees\ProcessingFeesRepositoryInterface;

class ProcessingFeesController extends Controller
{
    protected $Processing;
    public function __construct(ProcessingFeesRepositoryInterface $Processing)
    {
        $this->Processing = $Processing;
    }/**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Processing->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Processing->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Processing->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Processing->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Processing->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $Request)
    {
        return $this->Processing->destroy($Request);
    }
}

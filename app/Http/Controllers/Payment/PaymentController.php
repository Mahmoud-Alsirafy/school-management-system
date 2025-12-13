<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Payment\PaymentRepositoryInterface;

class PaymentController extends Controller
{
    protected $Payment;
    public function __construct(PaymentRepositoryInterface $Payment)
    {
        $this->Payment = $Payment;
    }/**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Payment->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Payment->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Payment->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Payment->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Payment->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $Request)
    {
        return $this->Payment->destroy($Request);
    }
}

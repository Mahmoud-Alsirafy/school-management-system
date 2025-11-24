<?php

namespace App\Http\Controllers\FeesInvoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Fees_invoices\Fees_invoicesRepositoryInterface;

class FeesInvoices extends Controller
{
      protected $Fees_invoices;
    public function __construct(Fees_invoicesRepositoryInterface $Fees_invoices)
    {
        $this->Fees_invoices = $Fees_invoices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return $this->Fees_invoices->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       return $this->Fees_invoices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Fees_invoices->ShowFeesInvoice($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Fees_invoices->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Fees_invoices->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Fees_invoices->delete($request);
    }
}

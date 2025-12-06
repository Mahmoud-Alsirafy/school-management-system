<?php

namespace App\Http\Controllers\ReceiptStudent;

use Illuminate\Http\Request;
use App\Models\ReceiptStudent;
use App\Http\Controllers\Controller;
use App\Repository\ReceiptStudent\ReceiptStudentRepositoryInterface;

class ReceiptStudentController extends Controller
{
    protected $Receipt;
    public function __construct(ReceiptStudentRepositoryInterface $Receipt)
    {
        $this->Receipt = $Receipt;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Receipt->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Receipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $Request)
    {
        return $this->Receipt->destroy($Request);
    }
}

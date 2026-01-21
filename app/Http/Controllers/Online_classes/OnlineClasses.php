<?php

namespace App\Http\Controllers\Online_classes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\OnlineClasses\OnlineClassesRepositoryInterface;

class OnlineClasses extends Controller
{
    protected $Online;
    public function __construct(OnlineClassesRepositoryInterface $Online)
    {
        $this->Online = $Online;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Online->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Online->create();
    }

    public function indirectCreate()
    {
        return $this->Online->indirectCreate();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Online->store($request);
    }


    public function storeIndirect(Request $request)
    {
        return $this->Online->storeIndirect($request);
    }


    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Request $request)
    // {
    //     return $this->Online->edit($request);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request)
    // {
    //     return $this->Online->update($request);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Online->delete($request);
    }
}

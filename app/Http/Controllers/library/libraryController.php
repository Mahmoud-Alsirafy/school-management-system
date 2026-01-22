<?php

namespace App\Http\Controllers\library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Library\LibraryRepositoryInterface;

class libraryController extends Controller
{

    protected $Library;

    public function __construct(LibraryRepositoryInterface $Library)
    {
        $this->Library = $Library;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Library->getAllBooks();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Library->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Library->StoreBooks($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Library->EditBooks($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Library->UpdateBooks($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Library->DeleteBooks($request);
    }
}

<?php

namespace App\Http\Controllers\ClassRooms;

use App\Models\Room;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $My_Classes=Room::all();
       $Grades = Grade::all();
        return view('pages.ClassRoom.class' , compact('Grades','My_Classes'));
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
        return "vsvsdiovs";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

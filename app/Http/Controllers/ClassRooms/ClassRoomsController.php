<?php

namespace App\Http\Controllers\ClassRooms;

use App\Models\Room;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\ClassRooms;
use App\Http\Controllers\Controller;

class ClassRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $My_Classes = Room::all();
        $Grades = Grade::all();
        return view('pages.ClassRoom.class', compact('Grades', 'My_Classes'));
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
    public function store(ClassRooms $request)
    {



        $List_Classes = $request->List_Classes;

        try {
            $validated = $request->validated();


            foreach ($List_Classes as $List_Class) {

                $My_Classes = new Room();

                $My_Classes->Name_Class = [$List_Class['Name_class_en'] => 'en',  $List_Class['Name'] => 'ar'];

                $My_Classes->Grade_id = $List_Class['Grade_id'];

                $My_Classes->save();
            }

            toastr()->success(trans('message.success'));
            return redirect()->route('classrooms.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
        // return $request;
        // if(Room::where('Name_Class',$request->Name)->orWhere('Name_Class',$request->Name_en)->exists()){
        //     toastr()->error(trans('Grades_trans.exists'));
        //     return redirect()->route('classrooms.index');
        // }

        try {

        $ClassRooms = Room::findOrFail($request->id);
        $ClassRooms->update([
        $ClassRooms->Name_Class = ['en' => $request->Name_en, 'ar' => $request->Name],
        $ClassRooms->Grade_id = $request->Grade_id,
        ]);
        $ClassRooms->save();
        toastr()->success(trans('message.update'));

            return redirect()->route('classrooms.index');
        } catch (\Throwable $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Grades = Room::findOrFail($request->id)->delete();
        toastr()->warning(trans('message.delete'));
        return redirect()->route('classrooms.index');
    }
}

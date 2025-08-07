<?php

namespace App\Http\Controllers\ClassRooms;

use App\Models\Room;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\ClassRooms;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\Return_;

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

                $My_Classes->Name_Class = ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']];

                $My_Classes->Grade_id = $List_Class['Grade_id'];

                $My_Classes->save();

            }

            toastr()->success(trans('message.success'));
            return redirect()->route('Classrooms.index');
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


        try {

        $ClassRooms = Room::findOrFail($request->id);
        $ClassRooms->update([
        $ClassRooms->Name_Class = ['en' => $request->Name_en, 'ar' => $request->Name],
        $ClassRooms->Grade_id = $request->Grade_id,
        ]);
        $ClassRooms->save();
        toastr()->success(trans('message.update'));

            return redirect()->route('Classrooms.index');
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
        return redirect()->route('Classrooms.index');
    }

    public function delete_all(Request $request)
    {
        // change from string to array
            $delete_all_id = explode(",", $request->delete_all_id);
            // wherein because it's a two thing
            Room::whereIn('id', $delete_all_id)->Delete();
            toastr()->error(trans('message.delete'));
            return redirect()->route('Classrooms.index');

    }

   
}

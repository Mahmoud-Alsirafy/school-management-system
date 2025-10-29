<?php

namespace App\Http\Controllers\Section;

use App\Models\Room;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;

class Sectioncoltroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view("pages.Section.section" , compact('Grades','list_Grades','teachers'));


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
    public function store(SectionRequest $request)
    {
        try {
            $validated = $request->validated();
        $Section = new Section ();
        $Section->Name_Section = ["en" => $request->Name_Section_En , "ar" => $request->Name_Section_Ar];
        $Section->Grade_id = $request->Grade_id;
        $Section->Classroom_id = $request->Classroom_id;
        $Section->Status = 1;
        $Section -> save();
        // attach only for add not for update because will repate the collom
        $Section->teachers()->attach($request->teacher_id);
        toastr()->success(trans('message.success'));
        return redirect()->route('Sections.index');
        } catch (\Throwable $e) {
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
    public function update(SectionRequest $request)
    {


      try {
        $validated = $request->validated();
        $Sections = Section::findOrFail($request->id);

        $Sections->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
        $Sections->Grade_id = $request->Grade_id;
        $Sections->Classroom_id = $request->Classroom_id;

        if(isset($request->Status)) {
          $Sections->Status = 1;
        } else {
          $Sections->Status = 2;
        }


         // update pivot tABLE
          if (isset($request->teacher_id)) {
            // sync for update becaues will check if the id is uesed and update in him
              $Sections->teachers()->sync($request->teacher_id);
          } else {
              $Sections->teachers()->sync(array());
          }


        $Sections->save();
        toastr()->success(trans('message.Update'));

        return redirect()->route('Sections.index');
    }
    catch
    (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = Section::findOrFail($request->id)->delete();
        toastr()->warning(trans('message.delete'));
        return redirect()->route('Sections.index');
    }
//
    public function get_classrooms($id)
    {
        $list_classes = Room::where("Grade_id", $id)->pluck("Name_Class", "id");

        return $list_classes;
    }
}

<?php

namespace App\Http\Controllers\Section;

use App\Models\Room;
use App\Models\Grade;
use App\Models\Section;
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
        return view("pages.Section.section" , compact('Grades','list_Grades'));


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
        $Section->Class_id = $request->Class_id;
        $Section->Status = 1;
        $Section -> save();
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
    public function update(Request $request)
{
    try {


        $section = Section::findOrFail($request->id);

        $section->update ( [
            $section->Name_Section = ['en' => $request->Name_Section_En,'ar' => $request->Name_Section_Ar
            ],
            $section->Grade_id = $request->Grade_id,
        $section->Class_id = $request->Class_id,
            'Status' => isset($request->Status) ? 1 : 2 // تم تبسيط شرط ال Status
        ]);

        $section->save();

        toastr()->success(trans('message.update'));

        return redirect()->route('Sections.index');

    } catch (\Throwable $e) {
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

<?php

namespace App\Http\Controllers\Grade;

use App\Models\Room;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Grade as GradeRequest;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Grades.grades' , compact('Grades'));
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
    public function store(GradeRequest $request)
    {
        if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){
            toastr()->error(trans('Grades_trans.exists'));
            return redirect()->route('grade.index');
        }

        try {
            $validated = $request->validated();
        $Grade = new Grade();
        $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
        $Grade->Notes = $request->Notes;
        $Grade->save();
        toastr()->success(trans('message.success'));

            return redirect()->route('grade.index');
        } catch (\Throwable $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){
            toastr()->error(trans('Grades_trans.exists'));
            return redirect()->route('grade.index');
        }

        try {

        $Grades = Grade::findOrFail($request->id);
        $Grades->update([
        $Grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
        $Grades->Notes = $request->Notes
        ]);
        $Grades->save();
        toastr()->success(trans('message.update'));

            return redirect()->route('grade.index');
        } catch (\Throwable $e) {
           return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $Class_id= Room::where('Grade_id', $request->id)->pluck('Grade_id');

        if($Class_id->count() == 0){
           $Grades = Grade::findOrFail($request->id)->delete();
        toastr()->warning(trans('message.delete'));
        return redirect()->route('grade.index');
        }
        else{
            toastr()->error(trans('Grades_trans.delete grade error'));
            return redirect()->route('grade.index');
        }


    }
}

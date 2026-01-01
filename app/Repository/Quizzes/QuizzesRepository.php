<?php

namespace App\Repository\Quizzes;

use App\Models\Quizzes;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class QuizzesRepository implements QuizzesRepositoryInterface
{
    public function index()
    {

        $quizzes = Quizzes::all();

        return view('pages.Quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('pages.Quizzes.create', compact("grades", 'subjects', 'teachers'));
    }

    public function Store($request)
    {
        $request->validate([
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'subject_id' => 'required|integer|exists:subjects,id',
            'teacher_id' => 'required|integer|exists:teachers,id',
            'Grade_id' => 'required|integer|exists:grades,id',
            'Classroom_id' => 'required|integer|exists:Classrooms,id',
            'section_id' => 'required|integer|exists:Sections,id',
        ]);
        DB::beginTransaction();
        try {

            $Quizzes = new Quizzes();
            $Quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Quizzes->term = $request->term;
            $Quizzes->subject_id = $request->subject_id;
            $Quizzes->grade_id = $request->Grade_id;
            $Quizzes->classroom_id = $request->Classroom_id;
            $Quizzes->section_id = $request->section_id;
            $Quizzes->teacher_id = $request->teacher_id;
            $Quizzes->save();
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Quizzes.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $quizz = Quizzes::findorfail($id);
        $grades = Grade::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();
        return view('pages.Quizzes.edit', compact('quizz', 'subjects','grades','teachers'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $Quizzes = Quizzes::findorfail($request->id);
            $Quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            // $Quizzes->term = $request->term;
            $Quizzes->subject_id = $request->subject_id;
            $Quizzes->grade_id = $request->Grade_id;
            $Quizzes->classroom_id = $request->Classroom_id;
            $Quizzes->section_id = $request->section_id;
            $Quizzes->teacher_id = $request->teacher_id;
            $Quizzes->save();
            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('Quizzes.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($request)
    {
        DB::beginTransaction();

        try {
            Quizzes::destroy($request->id);
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->route('Quizzes.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

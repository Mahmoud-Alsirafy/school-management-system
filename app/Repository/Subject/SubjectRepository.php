<?php

namespace App\Repository\Subject;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class SubjectRepository implements SubjectRepositoryInterface
{
    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.index', compact('subjects'));
    }

    public function create()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.create', compact('grades', 'teachers'));
    }

    public function Store($request)
    {
        $request->validate([
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Grade_id' => 'required|integer|exists:grades,id',
            'Class_id' => 'required|integer|exists:classrooms,id',
            'teacher_id' => 'required|integer|exists:teachers,id',
        ]);

        try {
            DB::beginTransaction();
            $Subject = new Subject();
            $Subject->Name = ["en" => $request->Name_en, "ar" => $request->Name_ar];
            $Subject->Grade_id = $request->Grade_id;
            $Subject->Classroom_id = $request->Class_id;
            $Subject->Teacher_id = $request->teacher_id;
            $Subject->save();
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('subjects.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $subject = Subject::findorfail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.edit', compact('subject','grades','teachers'));
    }

    public function update($request)
    {
        $request->validate([
            'id' => 'required',
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Grade_id' => 'required|integer|exists:grades,id',
            'Class_id' => 'required|integer|exists:classrooms,id',
            'teacher_id' => 'required|integer|exists:teachers,id',
        ]);

        try {
            DB::beginTransaction();
            $Subject = Subject::findorfail($request->id);
            $Subject->Name = ["en" => $request->Name_en, "ar" => $request->Name_ar];
            $Subject->Grade_id = $request->Grade_id;
            $Subject->Classroom_id = $request->Class_id;
            $Subject->Teacher_id = $request->teacher_id;
            $Subject->save();
            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('subjects.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function delete($request)
    {
        try {
            DB::beginTransaction();
            Subject::destroy($request->id);
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->route('subjects.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

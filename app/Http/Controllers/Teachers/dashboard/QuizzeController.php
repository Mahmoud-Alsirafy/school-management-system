<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Room;
use App\Models\Grade;
use App\Models\Quizzes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QuizzeController extends Controller
{

    public function index()
    {
      $teacherId = Auth::guard('teacher')->id();
      $quizzes = Quizzes::where('teacher_id' , $teacherId)->get();
      return view('pages.Teacher.dashboard.Quizzes.index',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('Teacher_id' , Auth::guard('teacher')->user()->id)->get();
      return view('pages.Teacher.dashboard.Quizzes.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'subject_id' => 'required|integer|exists:subjects,id',
            'Grade_id' => 'required|integer|exists:grades,id',
            'Classroom_id' => 'required|integer|exists:Classrooms,id',
            'section_id' => 'required|integer|exists:Sections,id',
        ]);
        DB::beginTransaction();
        try {
            $Quizzes = new Quizzes();
            $Quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Quizzes->subject_id = $request->subject_id;
            $Quizzes->grade_id = $request->Grade_id;
            $Quizzes->classroom_id = $request->Classroom_id;
            $Quizzes->section_id = $request->section_id;
            $Quizzes->teacher_id = Auth::guard('teacher')->id();
            $Quizzes->save();
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('qui_tea.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $questions = Question::where('quizze_id',$id)->get();
        $quizz = Quizzes::findorFail($id);
        return view('pages.Teacher.dashboard.Questions.index',compact('questions','quizz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $quizz = Quizzes::findorfail($id);
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('pages.Teacher.dashboard.Quizzes.edit', compact('quizz', 'subjects','grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $Quizzes = Quizzes::findorfail($id);
            $Quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Quizzes->subject_id = $request->subject_id;
            $Quizzes->grade_id = $request->Grade_id;
            $Quizzes->classroom_id = $request->Classroom_id;
            $Quizzes->section_id = $request->section_id;
            $Quizzes->teacher_id = Auth::guard('teacher')->id();
            $Quizzes->save();
            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('qui_tea.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Quizzes::destroy($id);
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->route('qui_tea.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

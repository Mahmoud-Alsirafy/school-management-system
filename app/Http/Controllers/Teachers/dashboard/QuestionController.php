<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Question::create([
                'title' => $request->title,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                'score' => $request->score,
                'quizze_id' => $request->quizz_id,
            ]);
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show(string $id)
    {
        $quizz_id = $id;
        return view('pages.Teacher.dashboard.Questions.create', compact('quizz_id'));
    }


    public function edit(string $id)
    {
        $question = Question::findorFail($id);
        return view('pages.Teacher.dashboard.Questions.edit', compact('question'));
    }


    public function update(Request $request, string $id)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $question = Question::findOrFail($id);
            $question->update([
                'title' => $request->title,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                'score' => $request->score,
            ]);
            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy(string $id)
    {
        DB::beginTransaction();
        $question = Question::findOrFail($id);
        try {
            $question->delete();
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Repository\Question;


use App\Models\Quizzes;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface
{
    public function index()
    {
        $questions = Question::all();
        return view("pages.Questions.index", compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizzes::all();
        return view("pages.Questions.create", compact("quizzes"));
    }

    public function Store($request)
    {
        DB::beginTransaction();
        try {
            Question::create([
                'title' => $request->title,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                'score' => $request->score,
                'quizze_id' => $request->quizze_id,
            ]);
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Question.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question =  Question::findOrfail($id);
        $quizzes = Quizzes::all();
        return view('pages.Questions.edit', compact("question", "quizzes"));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $question = Question::findOrFail($request->id);
            $question->update([
                'title' => $request->title,
                'answers' => $request->answers,
                'right_answer' => $request->right_answer,
                'score' => $request->score,
                'quizze_id' => $request->quizze_id,
            ]);
            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('Question.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($request)
    {
        DB::beginTransaction();
        $question = Question::findOrFail($request->id);
        try {
            $question->delete();
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->route('Question.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

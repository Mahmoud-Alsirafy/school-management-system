<?php

namespace App\Repository\Fees;

use App\Models\Fees;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class FeesRepository implements FeesRepositoryInterface
{
    public function index()
    {

        $fees = Fees::all();
        $Grades = Grade::all();
        return view('pages.Fees.index', compact('fees', 'Grades'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Fees.add', compact("Grades"));
    }

    public function Store($request)
    {
        // return $request;
        DB::beginTransaction();
        try {

            $Fees = new Fees();
            $Fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $Fees->amount = $request->amount;
            $Fees->Grade_id = $request->Grade_id;
            $Fees->Classroom_id = $request->Classroom_id;
            $Fees->description = $request->description;
            $Fees->year = $request->year;
            $Fees->Fee_type = $request->Fees_type;
            $Fees->save();

            // return "done";
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Fees.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee = Fees::findorfail($id);
        $Grades = Grade::all();
        return view('pages.Fees.edit', compact('fee', 'Grades'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $Fees = Fees::findorfail($request->id);
            $Fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $Fees->amount = $request->amount;
            $Fees->Grade_id = $request->Grade_id;
            $Fees->Classroom_id = $request->Classroom_id;
            $Fees->description = $request->description;
            $Fees->year = $request->year;
            $Fees->save();
            DB::commit();
            toastr()->success(trans('message.Update'));
            return redirect()->route('Fees.index');
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
            Fees::destroy($request->id);
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->route('Fees.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

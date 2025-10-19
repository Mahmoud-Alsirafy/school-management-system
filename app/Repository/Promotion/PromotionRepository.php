<?php

namespace App\Repository\Promotion;

use Exception;
use App\Models\Grade;
use App\Models\Student;
use App\Models\promotion;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class PromotionRepository implements PromotionRepositoryInterface
{
    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index', compact('Grades'));
        // return "hi";
    }

    public function create_promotion()
    {
        $promotions = promotion::all();
        return view('pages.Students.promotion.management', compact('promotions'));
    }

    public function store_promotion($request)
    {
        DB::beginTransaction();

        try {

            $students = Student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->where('academic_year', $request->academic_year)->get();
            // dd($students->count());
            // return $students;
            if ($students->count() < 1) {
                toastr()->error(trans('message.error'));
                return redirect()->back();
            }

            // update in table student
            foreach ($students as $student) {

                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)
                    ->update([
                        'Grade_id' => $request->Grade_id_new,
                        'Classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);

                // insert in to promotions
                promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function delete($request)
    {
        DB::beginTransaction();

        try {
            if (isset($request->id)) {
                $Promotion = promotion::findorfail($request->id);

                Student::where('id', $Promotion->student_id)

                    ->update([
                        'Grade_id' => $Promotion->from_grade,
                        'Classroom_id' => $Promotion->from_Classroom,
                        'section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.delete'));
                return redirect()->back();
            } else {
                $Promotions = Promotion::all();
                foreach ($Promotions as $Promotion){
   
                    //التحديث في جدول الطلاب
                    $ids = explode(',',$Promotion->student_id);
                    student::whereIn('id', $ids)
                    ->update([
                    'Grade_id'=>$Promotion->from_grade,
                    'Classroom_id'=>$Promotion->from_Classroom,
                    'section_id'=> $Promotion->from_section,
                    'academic_year'=>$Promotion->academic_year,
                  ]);
   
                    //حذف جدول الترقيات  (truncate) هيحزف الجدول كامل
                    Promotion::truncate();
   
                }
                   DB::commit();
                   toastr()->error(trans('messages.delete'));
                   return redirect()->back();
   
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

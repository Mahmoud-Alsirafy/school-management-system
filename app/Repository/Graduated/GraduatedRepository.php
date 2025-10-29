<?php
namespace App\Repository\Graduated;

use App\Models\Grade;
use App\Models\Student;

class GraduatedRepository implements GraduatedRepositoryInterface
{
    public function index(){
        $students = Student::onlyTrashed()->get();
        return view('pages.Students.Graduated.index',compact('students'));
    }

     public function create(){
        $Grades = Grade::all();
        return view('pages.Students.Graduated.create',compact('Grades'));
    }
    public function softDelete ($request) {
          $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }
            foreach ($students as $student){
            $ids = explode(',',$student->id);
            student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('message.success'));
        return redirect()->route('Graduated.index');
    }

    public function returnData($request){
        Student::onlyTrashed()->where("id",$request->id)->first()->restore();
          toastr()->success(trans('message.success'));
        return redirect()->back();
    }



    public function delete($request){
        Student::onlyTrashed()->where("id",$request->id)->first()->forceDelete();
          toastr()->error(trans('message.delete'));
        return redirect()->back();
    }
}



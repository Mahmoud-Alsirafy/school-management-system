<?php

namespace App\Repository\Teacher;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getAllTeacher()
    {
       $Teachers = Teacher::all();
        return view('pages.Teacher.Teachers',compact('Teachers'));
    }

    public function GetSpecialization(){
        return Specialization::all();
    }
    public function GetGender(){
        return Gender::all();
    }

    public function StoreTeacher($request)
    {
        try {
            $Teacher = new Teacher ();
            $Teacher->Email = $request->Email;
            $Teacher->Password = Hash::make($request->Password);
            $Teacher->Name = ["en" => $request->Name_en , "ar" => $request->Name_ar];
            $Teacher->Specialization_id = $request->Specialization_id;
            $Teacher->Gender_id = $request->Gender_id;
            $Teacher->Joining_Date = $request->Joining_Date;
            $Teacher->Address = $request->Address;
            $Teacher -> save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Teachers.index');
            } catch (\Throwable $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }

    public function EditTeacher($id){
        return Teacher::findOrFail($id);

    }


    public function UpdateTeacher($request)
    {
        try {
            $Teacher = Teacher::findOrFail($request->id);
            $Teacher->Email = $request->Email;
            $Teacher->Password = Hash::make($request->Password);
            $Teacher->Name = ["en" => $request->Name_en , "ar" => $request->Name_ar];
            $Teacher->Specialization_id = $request->Specialization_id;
            $Teacher->Gender_id = $request->Gender_id;
            $Teacher->Joining_Date = $request->Joining_Date;
            $Teacher->Address = $request->Address;
            $Teacher -> save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Teachers.index');
            } catch (\Throwable $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
    }


    public function DeleteTeacher ($request)
    {
        try {
            $Teacher = Teacher::findOrFail($request->id)->delete();
        toastr()->success(trans('message.delete'));
            return redirect()->route('Teachers.index');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

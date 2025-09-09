<?php

namespace App\Repository;

use App\Models\Room;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Student;
use App\Models\My_Parent;
use App\Models\Type_Blood;
use App\Models\Nationality;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface
{
    // Show Table To Add The Students
    public function Create_Student(){
       $data['Genders']=Gender::all();
       $data['nationals']=Nationality::all();
       $data['bloods']=Type_Blood::all();
       $data['my_classes']=Grade::all();
       $data['parents']=My_Parent::all();
       return view('pages.Students.add',$data);
    }

    public function Get_All_Studens(){
        $students = Student::all();
        return view("pages.Students.index" , compact('students'));
    }

    // Store Studens In DB
    public function Store_Students($request){
        try {
            $Student = new Student();
            $Student->name = ["en" => $request->name_en , "ar" => $request->name_ar];
            $Student->email = $request->email;
            $Student->password = Hash::make($request->password);
            $Student->gender_id = $request->gender_id;
            $Student->nationalitie_id = $request->nationalitie_id;
            $Student->blood_id= $request->blood_id;
            $Student->Date_Birth = $request->Date_Birth;
            $Student->Grade_id = $request->Grade_id;
            $Student->Classroom_id = $request->Classroom_id;
            $Student->section_id = $request->section_id;
            $Student->parent_id = $request->parent_id;
            $Student->academic_year = $request->academic_year;
            $Student -> save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Students.create');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

     // Show Student Info To Reade
     public function Show_Students_Info($id){
        $Student = Student::findorfail($id);
        return view("pages.Students.show",compact("Student"));
    }

    //  Show Info And Edit
    public function Edit_Students_Info($id){
        $data['Grades'] = Grade::all();
        $data['parents'] = My_Parent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Type_Blood::all();
        $Students =  Student::findOrFail($id);
        return view('pages.Students.edit',$data,compact('Students'));
    }

    // Update Student Info
    public function Update_Students_Info($request){
        try {
            $Student =Student::findorfail($request->id);
            $Student->name = ["en" => $request->name_en , "ar" => $request->name_ar];
            $Student->email = $request->email;
            $Student->password = Hash::make($request->password);
            $Student->gender_id = $request->gender_id;
            $Student->nationalitie_id = $request->nationalitie_id;
            $Student->blood_id= $request->blood_id;
            $Student->Date_Birth = $request->Date_Birth;
            $Student->Grade_id = $request->Grade_id;
            $Student->Classroom_id = $request->Classroom_id;
            $Student->section_id = $request->section_id;
            $Student->parent_id = $request->parent_id;
            $Student->academic_year = $request->academic_year;
            $Student -> save();
            toastr()->success(trans('message.update'));
            return redirect()->route('Students.index');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

     // Delete Student From DB

     public function Delete_Student($request)
     {

         Student::destroy($request->id);
         toastr()->error(trans('message.delete'));
         return redirect()->route('Students.index');
     }


    // Get The Class Name To Added To Student Table
    public function Get_classrooms($id){
        $list_classes = Room::where('Grade_id', $id)->pluck('Name_Class','id');
        return $list_classes;
    }

    // Get The Section Name To Added To Student Table

    public function Get_Sections($id){
        $list_sections = Section::where("Classroom_id", $id)->pluck("Name_Section","id");
        return $list_sections;
    }
}

<?php

namespace App\Repository\Attendance;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    // Show Table To Add The Students
    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }
    // Store Studens In DB
    public function store($request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->attendences as $Student_id => $attendence) {
                if ($attendence == 'presence') {
                    $attendence_Status = true;
                } else {
                    $attendence_Status = false;
                }

                Attendance::create([
                    'student_id'=> $Student_id,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> 1,
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_Status,
                ]);
            }

            DB::commit();

            toastr()->success(trans('message.success'));
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Show Student Info To Reade
    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.Attendance.index',compact('students'));
    }

    //  Show Info And Edit
    public function edit($id)
    {
        //
    }

    // Update Student Info
    public function update($request)
    {
        //
    }


    // Delete Student From DB

    public function destroy($request)
    {
        $request->validate([
            'id' => 'required|integer|exists:processing_fees,id',
        ]);
        DB::beginTransaction();
        try {
            // Payment_student::destroy($request->id);
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

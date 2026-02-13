<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher_id = Teacher::find(Auth::guard('teacher')->user()->id)->section()->pluck('section_id');
        // $data['count'] = $teacher_id->count();
        $students = Student::whereIn('section_id', $teacher_id)->get();
        return view('pages.Teacher.dashboard.students.index', compact('students'));
    }
    public function sections()
    {
        $teacher_id = Teacher::find(Auth::guard('teacher')->user()->id)->section()->pluck('section_id');
        $sections = Section::whereIn('id', $teacher_id)->get();
        return view('pages.Teacher.dashboard.sections.index', compact('sections'));
    }

    public function attendance(Request $request)
    {
        try {

            $attenddate = date('Y-m-d');
            foreach ($request->attendences as $studentid => $attendence) {

                if ($attendence == 'presence') {
                    $attendence_status = true;
                } else if ($attendence == 'absent') {
                    $attendence_status = false;
                }

                Attendance::updateorCreate(
                    [
                        'student_id' => $studentid,
                        'attendence_date' => $attenddate
                    ],
                    [
                        'student_id' => $studentid,
                        'grade_id' => $request->grade_id,
                        'classroom_id' => $request->classroom_id,
                        'section_id' => $request->section_id,
                        'teacher_id' => 1,
                        'attendence_date' => $attenddate,
                        'attendence_status' => $attendence_status
                    ]
                );
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function attendance_report()
    {
        $ids = Teacher::find(Auth::guard('teacher')->user()->id)->section()->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.Teacher.dashboard.students.attendance_report', compact('students'));
    }


    public function attendance_search(Request $request)
    {

        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان يكون اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);


        $ids = Teacher::find(Auth::guard('teacher')->user()->id)->section()->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();

        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.Teacher.dashboard.students.attendance_report', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.Teacher.dashboard.students.attendance_report', compact('Students', 'students'));
        }
    }
}

<?php

namespace App\Http\Controllers\Parent\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::where('parent_id', Auth::guard('parent')->user()->id)->get();
        return view('pages.Parents.Dashboard.children.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function results($id)
    {
       $student = Student::findorFail($id);

        if ($student->parent_id !==  Auth::guard('parent')->user()->id  ) {
            toastr()->error('يوجد خطا في كود الطالب');
            return redirect()->route('sons');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error('لا توجد نتائج لهذا الطالب');
            return redirect()->route('sons');
        }

        return view('pages.parents.Dashboard.degrees.index', compact('degrees'));
    }

    public function attendances()
    {
        $students = Student::where('parent_id', Auth::guard('parent')->user()->id)->get();
        return view('pages.Parents.Dashboard.Attendance.index', compact('students'));
    }
}

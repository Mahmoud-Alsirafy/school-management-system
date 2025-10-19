<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Repository\Teacher\TeacherRepositoryInterface;



class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }
    public function index()
    {
        return $this->Teacher->getAllTeacher();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->Teacher->GetSpecialization();
        $genders = $this->Teacher->GetGender();
        return view('pages.Teacher.create',compact('specializations','genders'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(TeacherRequest $request)
    {
        return $this->Teacher->StoreTeacher($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Teachers = $this->Teacher->EditTeacher($id);
        $specializations = $this->Teacher->GetSpecialization();
        $genders = $this->Teacher->GetGender();

        return view('pages.Teacher.Edit',compact('specializations','genders','Teachers'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       return $this->Teacher->UpdateTeacher($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeacher($request);
    }
}

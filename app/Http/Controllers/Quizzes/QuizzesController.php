<?php

namespace App\Http\Controllers\Quizzes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Quizzes\QuizzesRepositoryInterface;

class QuizzesController extends Controller
{
   protected $Quizzes;
    public function __construct(QuizzesRepositoryInterface $Quizzes)
    {
        $this->Quizzes = $Quizzes;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Quizzes->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Quizzes->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function create()
    {
        return $this->Quizzes->create();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Quizzes->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Quizzes->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $Request)
    {
        return $this->Quizzes->delete($Request);
    }
}

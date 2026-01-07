<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuiestionRequest;
use App\Repository\Question\QuestionRepositoryInterface;

class QuestionController extends Controller
{

    protected $Question;
    public function __construct(QuestionRepositoryInterface $Question)
    {
        $this->Question = $Question;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Question->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Question->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuiestionRequest $request)
    {
        return $this->Question->store($request);
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
        return $this->Question->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuiestionRequest $request, string $id)
    {
        return $this->Question->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Question->delete($request);
    }
}

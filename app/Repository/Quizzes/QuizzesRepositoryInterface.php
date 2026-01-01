<?php

namespace App\Repository\Quizzes;

interface QuizzesRepositoryInterface
{
    public function index();
    public function create();
    public function edit($request);
    public function Store($request);
    public function update($request);
    public function delete($request);


}

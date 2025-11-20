<?php

namespace App\Repository\Fees;

interface FeesRepositoryInterface
{
    public function index();
    public function create();
    public function edit($id);
    public function Store($request);
    public function update($request);
    public function delete($request);


}

<?php

namespace App\Repository\Graduated;

interface GraduatedRepositoryInterface
{
    public function index();
    public function create();
    public function softDelete($request);
    public function returnData($request);
    public function delete($request);
}

<?php

namespace App\Repository\OnlineClasses;

interface OnlineClassesRepositoryInterface
{
    public function index();
    public function create();
    public function Store($request);
    public function delete($request);
    public function indirectCreate();
    public function storeIndirect($request);

}

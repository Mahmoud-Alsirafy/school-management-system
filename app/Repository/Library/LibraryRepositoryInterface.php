<?php

namespace App\Repository\Library;

interface LibraryRepositoryInterface
{
    public function getAllBooks();

    public function create();

    public function StoreBooks($request);

    public function EditBooks($id);

    public function UpdateBooks($request);

    public function DeleteBooks($request);

    public function downloadAttach($id);
}

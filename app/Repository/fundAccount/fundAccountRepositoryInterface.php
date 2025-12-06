<?php
namespace App\Repository\fundAccount;

interface fundAccountRepositoryInterface{


    // Create A New Students
    public function index();


    // Get All Students Info
    public function create();


    // Store Students In DB
    public function store($request);


    // Show Student Info To Reade
    public function show($id);


    // Edit Student Info
    public function edit($id);


    // Update Student Info And Save
    public function update($request);


    // Delete Student From DB
    public function destroy($request);





}

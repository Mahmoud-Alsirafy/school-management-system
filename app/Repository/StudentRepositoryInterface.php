<?php
namespace App\Repository;

interface StudentRepositoryInterface{


    // Create A New Students
    public function Create_Student();


    // Get All Students Info
    public function Get_All_Studens();


    // Store Students In DB
    public function Store_Students($request);


    // Show Student Info To Reade
    public function Show_Students_Info($id);


    // Edit Student Info
    public function Edit_Students_Info($id);


    // Update Student Info And Save
    public function Update_Students_Info($request);


    // Delete Student From DB
    public function Delete_Student($request);

    // Get ClassRoom Name
    public function Get_classrooms($id);


    // Get Sections Name
    public function Get_Sections($id);




}

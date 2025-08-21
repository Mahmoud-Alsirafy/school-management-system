<?php
namespace App\Repository;

interface TeacherRepositoryInterface{
// Get All Teacher From DB
public function getAllTeacher();

// Get All Specialization
public function GetSpecialization();

// Get All Gender
public function GetGender();

// Store Teacher
public function StoreTeacher($request);

// Edit Teacher
public function EditTeacher($id);
// Update Teacher
public function UpdateTeacher($request);

// Delete Teacher
public function DeleteTeacher($request);
}

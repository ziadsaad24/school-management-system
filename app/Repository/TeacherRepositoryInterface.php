<?php

namespace App\Repository;
interface TeacherRepositoryInterface 
{
    public function getAllTeachers();
    public function spelializations();
    public function genders();
    public function StoreTeachers($request);
     public function EditTeachers($id);
    public function UpdateTeachers($request);
    public function DeleteTeachers($id);
}
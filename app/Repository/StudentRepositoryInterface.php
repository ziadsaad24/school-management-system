<?php

namespace App\Repository;
interface StudentRepositoryInterface 
{
    public function Create_Students();
    public function Get_classrooms($id);
    public function Get_Sections($id);
    public function StoreStudents($request);
    public function getStudents();
    public function EditStudents($id);
    public function UpdateStudents($request);
    public function DeleteStudents($id);
    public function ShowStudents($id);
    public function Upload_attachment($request);
    public function Download_attachment($student_id,$file_name);
    public function Delete_attachment($request);
}
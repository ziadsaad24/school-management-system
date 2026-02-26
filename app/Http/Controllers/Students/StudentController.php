<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreStudentsRequest;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student){
        $this->Student = $Student;
    }
    public function index()
    {
        return $this->Student->getStudents();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return $this->Student->Create_Students();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentsRequest $request)
    {
        return $this->Student->StoreStudents($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Student->ShowStudents($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Student->EditStudents($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentsRequest $request)
    {
        return $this->Student->UpdateStudents($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->Student->DeleteStudents($id);
    }
    public function Get_classrooms($id){
        return $this->Student->Get_classrooms($id);
    }
    public function Get_Sections($id){
        return $this->Student->Get_Sections($id);  
    }
    public function Upload_attachment(Request $request){
        return $this->Student->Upload_attachment($request);
    }
    public function Download_attachment($student_id,$file_name){
        return $this->Student->Download_attachment($student_id,$file_name);
    }
    public function Delete_attachment(Request $request){
        return $this->Student->Delete_attachment($request);
    }
}

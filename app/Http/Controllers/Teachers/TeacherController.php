<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;
class TeacherController extends Controller
{
    protected $Teacher;
    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     $Teachers= $this->Teacher->getAllTeachers();
     return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     $spelializations= $this->Teacher->spelializations();
    $genders= $this->Teacher->genders();
    return view('pages.Teachers.create',compact('spelializations','genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeachers $request)
    {
      return $this->Teacher->StoreTeachers($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id )
    {
        $spelializations= $this->Teacher->spelializations();
        $genders= $this->Teacher->genders();
        $Teachers = $this->Teacher->EditTeachers($id);
        
        return view('pages.Teachers.edit',compact('Teachers','spelializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         return $this->Teacher->UpdateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->Teacher->DeleteTeachers($id);
    }
}

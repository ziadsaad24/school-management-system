<?php

namespace App\Repository;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    // Repository methods would go here
    public function index()
    {
        // Implementation of index method
        $Grades= Grade::with('Sections')->get();
        $list_Grades=Grade::all();
        $teachers=Teacher::all();
        return view('pages.Attendance.Sections',compact('Grades','list_Grades','teachers'));
    }
    public function store($request)
    {
      try{
        $attenddate=date('Y-m-d');
        $classId = $request->section_id;
        foreach($request->attendances as $studentid=>$attendace){
            if($attendace == 'presence'){
                $attendance_status = true;
            }else if($attendace == 'absent'){
                $attendance_status = false;
            }
            Attendance::create([
                'attendance_date' => $attenddate,
                'student_id' => $studentid,
                'grade_id' => $request->Grade_id,
                'classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => $request->teacher_id,
                'attendance_status' => $attendance_status,
            ]);

        }
        return redirect()->back()->with('success', 'تمت اضافة الحضور والغياب بنجاح');

      }
      catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
    }
    public function show($id)
    {
     $Students = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.Attendance.index',compact('Students'));  
    }
    public function update($request)
    {
        // Implementation of update method
    }
    public function destroy($request)
    {
        // Implementation of destroy method
    }
}
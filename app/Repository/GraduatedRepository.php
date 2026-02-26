<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;



class GraduatedRepository implements GraduatedRepositoryInterface
{
    public function index()
    {
        $students=Student::onlyTrashed()->get(); //جلب الطلاب المتخرجين only softdeleted
        return view('pages.Students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades=Grade::all();
        return view('pages.Students.Graduated.create',compact('Grades'));
    }   
    public function softDelete($request)
    {
        $students= Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
        if($students->count()<1){
            return redirect()->back()->withErrors(['error'=>'لاتوجد بيانات في جدول الطلاب']);
        }
        foreach($students as $student){
            $ids=explode(',',$student->id);
            Student::whereIn('id',$ids)->Delete();
        }
        return redirect()->route('Graduated.index')->with('success','تمت عملية التخرج بنجاح');
    }


    public function Returndata($request)
    {
        $students= Student::onlyTrashed()->where('id',$request->id)->first()->restore();
        if(!$students){
            return redirect()->back()->withErrors(['error'=>'لاتوجد بيانات في جدول الطلاب']);
        }
        return redirect()->back()->with('success','تمت استعادة البيانات بنجاح');
    }
   public function Delete($request)
{
    $student = Student::onlyTrashed()->where('id', $request->id)->first();

    if (!$student) {
        return redirect()->back()->withErrors(['error' => 'الطالب غير موجود أو لم يتم حذفه مسبقًا']);
    }

    $student->forceDelete();

    return redirect()->back()->with('success', 'تم حذف الطالب نهائيًا بنجاح');
}
   public function  Delete_one($request)
{
    $student = Student::where('id', $request->id)->first();

    if (!$student) {
        return redirect()->back()->withErrors(['error' => 'لاتوجد بيانات في جدول الطلاب']);
    }
//Promotion::where('student_id',$student->id)->delete();
    $student->delete(); // حذف عادي (Soft Delete لو معمول use SoftDeletes)
    return redirect()->route('Graduated.index')->with('success', 'تم حذف البيانات بنجاح');
}


}
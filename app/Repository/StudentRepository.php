<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use DB;
use Flasher\Prime\Storage\Storage;
use Hash;


class StudentRepository implements StudentRepositoryInterface
{
    public function Create_Students()
    {
        $data['my_classes']=Grade::all();
        $data['parents']=My_Parent::all();
        $data['Genders']=Gender::all();
        $data['bloods']=Type_Blood::all();
        $data['nationals']=Nationalitie::all();
        return view('pages.Students.add',$data);
    }

    public function Get_classrooms($id){
        $list_classes = Classroom::where('Grade_id',$id)->pluck('Name_Class','id');
        return $list_classes;
    }
    public function Get_Sections($id){
        $list_sections = Section::where('Class_id',$id)->pluck('Name_Section','id');
        return $list_sections;
    }
    public function StoreStudents($request){
        DB::beginTransaction();
        try{
            $studenst=new Student();
            $studenst->name=['en'=>$request->name_en,'ar'=>$request->name_ar];
            $studenst->email=$request->email;
            $studenst->password=Hash::make($request->password);
            $studenst->gender_id=$request->gender_id;
            $studenst->nationalitie_id=$request->nationalitie_id;
            $studenst->blood_id=$request->blood_id;
            $studenst->Date_Birth=$request->Date_Birth;
            $studenst->Grade_id=$request->Grade_id;
            $studenst->Classroom_id=$request->Classroom_id;
            $studenst->section_id=$request->section_id;
            $studenst->parent_id=$request->parent_id;
            $studenst->academic_year=$request->academic_year;
            $studenst->save();
             // insert images
             if($request->hasfile('photos')){
                foreach($request->file('photos')as $file){
                    $name = time() . '_' . $file->getClientOriginalName();  //jpg or png ..
                    $file->storeAs('attachments/students/'.$studenst->id,$name,'upload_attachments'); //كود تخزين الصور بياخد 3 براميتر اول مكان التخزين التاني اسم الصورة التالت نوع الدريف 
                    $images=new Image();
                    $images->filename=$name;
                    $images->imageable_id=$studenst->id;
                    $images->imageable_type=Student::class;
                    $images->save();
                }

             }
            DB::commit();
            toastr()->success(trans('messages.success'));
            // Redirect with flash message so it's available after redirect
            return redirect()->route('Students.create')->with('success', trans('messages.success'));
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function getStudents(){
        $students=Student::all();
        return view('pages.Students.index',compact('students'));
    }
    public function EditStudents($id){
        $data['Grades']=Grade::all();   
        $data['parents']=My_Parent::all();
        $data['Genders']=Gender::all();
        $data['bloods']=Type_Blood::all();
        $data['nationals']=Nationalitie::all();
        $Students=Student::findOrFail($id);
        return view('pages.Students.edit',compact('Students'),$data);
    }
    public function UpdateStudents($request){
        try{
            $studenst=Student::findOrFail($request->id);
            $studenst->name=['en'=>$request->name_en,'ar'=>$request->name_ar];
            $studenst->email=$request->email;
            $studenst->password=Hash::make($request->password);
            $studenst->gender_id=$request->gender_id;
            $studenst->nationalitie_id=$request->nationalitie_id;
            $studenst->blood_id=$request->blood_id;
            $studenst->Date_Birth=$request->Date_Birth;
            $studenst->Grade_id=$request->Grade_id;
            $studenst->Classroom_id=$request->Classroom_id;
            $studenst->section_id=$request->section_id;
            $studenst->parent_id=$request->parent_id;
            $studenst->academic_year=$request->academic_year;
            $studenst->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Students.index')->with('success', trans('messages.success'));
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
 }
    public function DeleteStudents($id){
    Student::destroy($id);
    toastr()->success('تم الحذف بنجاح');
    return redirect()->route('Students.index')->with('success', 'تم الحذف بنجاح');
    }
    public function ShowStudents($id){
        $Student=Student::findOrFail($id);
        return view('pages.Students.show',compact('Student'));
    }
    public function Upload_attachment($request){
        try{
            if($request->hasfile('photos')){
                foreach($request->file('photos')as $file){
                    $name = time() . '_' . $file->getClientOriginalName();  //jpg or png ..
                    $file->storeAs('attachments/students/'.$request->student_id,$name,'upload_attachments'); //كود تخزين الصور بياخد 3 براميتر اول مكان التخزين التاني اسم الصورة التالت نوع الدريف 
                    $images=new Image();
                    $images->filename=$name;
                    $images->imageable_id=$request->student_id;
                    $images->imageable_type=Student::class;
                    $images->save();
                    toastr()->success(trans('messages.success'));
                    return redirect()->route('Students.show',$request->student_id)->with('success', trans('messages.success'));
                }

             }
            
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
}
    public function Download_attachment($student_id,$file_name){
        return response()->download(public_path('attachments/students/'.$student_id.'/'.$file_name));
    }
    public function Delete_attachment($request){
        // Build the relative path used on the 'upload_attachments' disk
        $relativePath = 'attachments/students/' . $request->student_id . '/' . $request->filename;

        try {
            $disk = \Illuminate\Support\Facades\Storage::disk('upload_attachments');

            // Check existence first
            if ($disk->exists($relativePath)) {
                $deleted = $disk->delete($relativePath);
            } else {
                $deleted = false;
            }

            // Fallback: try direct filesystem unlink if Storage failed or file still exists
            if (!$deleted) {
                $fullPath = public_path($relativePath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                    $deleted = !file_exists($fullPath);
                }
            }

            if ($deleted) {
                // Remove DB record only after successful file removal
                Image::where('id', $request->id)->where('filename', $request->filename)->delete();
                toastr()->success(trans('messages.Delete'));
                return redirect()->route('Students.show', $request->student_id)->with('success', trans('messages.Delete'));
            }

            // If we get here deletion failed
            return redirect()->route('Students.show', $request->student_id)
                ->with(['error' => trans('Students_trans.File_delete_failed') ?? 'File could not be deleted from disk.']);

        } catch (\Exception $e) {
            return redirect()->route('Students.show', $request->student_id)
                ->with(['error' => $e->getMessage()]);
        }
    }
}
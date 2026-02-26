<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index',compact('Grades'));
    }

    public function create()
    {
        $promotions = Promotion::all();
        $student= Student::all();
        return view('pages.Students.promotion.management',compact('promotions','student'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            // log incoming payload to help debug no-op cases
            Log::info('Promotion.store payload', (array) $request->all());

            $students = Student::where('Grade_id',$request->Grade_id)
                ->where('Classroom_id',$request->Classroom_id)
                ->where('section_id',$request->section_id)
                ->where('academic_year',$request->academic_year)
                ->get();

            Log::info('Promotion.store matched students count: '.$students->count());
            if($students->count() < 1){
                Log::warning('Promotion.store no students matched for payload', (array) $request->all());
                return redirect()->back()->withErrors(['error' => __('لاتوجد بيانات في جدول الطلاب')]);
            }

            // update students and record promotions
            foreach ($students as $student){
                // update this single student by id
                Student::where('id', $student->id)
                    ->update([
                        'Grade_id' => $request->Grade_id_new,
                        'Classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);

                // insert or update promotion record for this student
                Promotion::updateOrCreate(
                    ['student_id' => $student->id],
                    [
                        'from_grade' => $request->Grade_id,
                        'from_Classroom' => $request->Classroom_id,
                        'from_section' => $request->section_id,
                        'to_grade' => $request->Grade_id_new,
                        'to_Classroom' => $request->Classroom_id_new,
                        'to_section' => $request->section_id_new,
                        'academic_year' => $request->academic_year,
                        'academic_year_new' => $request->academic_year_new,
                    ]
                );
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

             $Promotions = Promotion::all();
             foreach ($Promotions as $Promotion){
                 // student_id may be a single id or comma-separated list; normalize
                 $ids = is_string($Promotion->student_id) && strpos($Promotion->student_id, ',') !== false
                     ? array_map('trim', explode(',', $Promotion->student_id))
                     : [$Promotion->student_id];

                 Student::whereIn('id', $ids)
                     ->update([
                         'Grade_id' => $Promotion->from_grade,
                         'Classroom_id' => $Promotion->from_Classroom,
                         'section_id' => $Promotion->from_section,
                         'academic_year' => $Promotion->academic_year,
                     ]);
             }

             // delete all promotions after restoring students
             Promotion::truncate();
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();


            }
            else{
                $Promotion= Promotion::findOrFail($request->id);
                Student::where('id',$Promotion->student_id)
                    ->update([
                        'Grade_id' => $Promotion->from_grade,
                        'Classroom_id' => $Promotion->from_Classroom,
                        'section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);
                    Promotion::destroy($request->id);
                DB::commit();
                
                return redirect()->back()->with('success', trans('messages.Delete'));
            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}

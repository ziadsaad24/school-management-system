<?php

namespace App\Repository;

use App\Models\Exam;


class ExamRepository implements ExamRepositoryInterface
{
    //code here
    public function index()
    {
        $exams = Exam::all();
        return view('pages.Exams.index', compact('exams'));

    }
    public function create()
    {
        return view('pages.Exams.create');
    }
    public function store($request){
        try{
            $exam = new Exam();
            $exam->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $exam->term = $request->term;
            $exam->academic_year = $request->academic_year;
            $exam->save();
            toastr()->success('تمت الإضافة بنجاح');
            return redirect()->route('Exams.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id){
        $exam = Exam::findOrFail($id);
        return view('pages.Exams.edit', compact('exam'));
    }
    public function update($request){
        try{
            $exam = Exam::findOrFail($request->id);
            $exam->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $exam->term = $request->term;
            $exam->academic_year = $request->academic_year;
            $exam->save();
            toastr()->success('تم التحديث بنجاح');
            return redirect()->route('Exams.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request){
        try{
            Exam::destroy($request->id);
            toastr()->success('تم الحذف بنجاح');
            return redirect()->route('Exams.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
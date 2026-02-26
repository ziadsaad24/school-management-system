<?php

namespace App\Repository;

use App\Models\Classroom;
use App\Models\Fee;
use App\Models\Grade;


class FeesRepository implements FeesRepositoryInterface 
{
    // Implement method signatures defined in FeesRepositoryInterface here

    public function index()
    {
      $fees= Fee::all();
      $Grades= Grade::all();
      return view('pages.Fees.index',compact('fees','Grades'));   // Implementation of index method
    }
    public function create()
    {
        // Implementation of create method
        $Grades = Grade::all();
        return view('pages.Fees.create', compact('Grades'));

    }
    public function store($request)
    {
        try{// Implementation of store method
        Fee::create([
            'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
            'amount' => $request->amount,
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'description' => $request->description,
            'year' => $request->year,
            'Fee_type' => $request->Fee_type,
        ]);

        return redirect()->route('Fees.index')->with('success', 'Fee created successfully.');
    }
    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }
    public function edit($id)
    {
        // Implementation of edit method
        $fee = Fee::findOrFail($id);
        $Grades = Grade::all();
        $Classrooms = Classroom::where('Grade_id', $fee->Grade_id)->get();
        return view('pages.Fees.edit', compact('fee', 'Grades','Classrooms'));
    }
    public function update($request)
    {
        try {
            $fee = Fee::findOrFail($request->id);
            $fee->update([
                'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
                'amount' => $request->amount,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'description' => $request->description,
                'year' => $request->year,
                'Fee_type' => $request->Fee_type,
            ]);

            return redirect()->route('Fees.index')->with('success', 'Fee updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        // Implementation of destroy method
        try {
            $fee = Fee::findOrFail($request->id);
            $fee->delete();

            return redirect()->route('Fees.index')->with('success', 'Fee deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
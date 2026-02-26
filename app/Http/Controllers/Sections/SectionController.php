<?php

namespace App\Http\Controllers\Sections;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionsRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades=Grade::with('Sections')->get();
        $list_Grades=Grade::all();
        $Sections=Section::all();
        $teachers=Teacher::all();
        return view('pages.Sections.Sections',compact('Grades','list_Grades','Sections','teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionsRequest $request)
    {
        try{
            $validated=$request->validated();
            $Section=new Section();
            $Section->Name_Section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
            $Section->Grade_id=$request->Grade_id;
            $Section->Class_id=$request->Class_id;
            $Section->Status=1;
            $Section->save();
            $Section->teachers()->attach($request->teacher_id);
            return redirect()->route('Sections.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSectionsRequest $request, $id)
    {
        try{
             $validated=$request->validated();
             $Sections=Section::findOrFail($id);
             $Sections->Name_Section=['ar'=>$request->Name_Section_Ar,'en'=>$request->Name_Section_En];
            $Sections->Grade_id=$request->Grade_id;
            $Sections->Class_id=$request->Class_id;
            if(isset($request->Status)){
                $Sections->Status=1;
            } else{
                $Sections->Status=0;
            }
            if(isset($request->teacher_id)){
                $Sections->teachers()->sync($request->teacher_id);  //sync used to update the many to many relationship
            } else{
                $Sections->teachers()->sync(array()); 
            }
            $Sections->save();
            return redirect()->route('Sections.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' =>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Section::destroy($id);
        return redirect()->route('Sections.index');
    }
    public function getclasses($id){
        $list_classes= Classroom::where("Grade_id",$id)->pluck('Name_Class',"id");
        return $list_classes;
    }
}

<?php 


namespace App\Http\Controllers\Grades;
use App\Http\Controllers\Controller;



use App\Http\Requests\StoreGrades;
use App\Models\Grade;

use Illuminate\Http\Request;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $grades=Grade::all();
    return view('pages.Grades.Grades',compact('grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGrades $request)
  {
    if(Grade::where('Name->ar',$request->Name_ar)->orWhere('Name->en',$request->Name_en)->exists()){
        return redirect()->back()->withErrors(trans('Grades_trans.exists'));
    }
    $validated= $request->validated();
    $grade=new Grade();
    $grade->Name=['en'=>$request->Name_en,'ar'=>$request->Name_ar];
    $grade->Notes=$request->Notes;
    $grade->save();
     toastr()->success('تمت الإضافة بنجاح');
    return redirect()->back();
  } 

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
 public function update(StoreGrades $request,$id)
{
    $validated= $request->validated();
    $grade = Grade::findOrFail($id);

    $grade->Name = [
        'en' => $request->Name_en,
        'ar' => $request->Name_ar,
    ];

    $grade->Notes = $request->Notes;

    $grade->save();

    toastr()->success('تم التعديل بنجاح');
    return redirect()->route('Grades.index');
}

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    Grade::destroy($id);
    return redirect()->route('Grades.index');
  }
   
}
?>
<?php 

namespace App\Http\Controllers\Classrooms;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use Mockery\Expectation;
class ClassroomController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $My_Classes=Classroom::all();
   $grades=Grade::all();
    return view('pages.My_Classes.My_Classes',compact('grades','My_Classes'));
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
  public function store(Request $request)
  {
  //   $this->validate($request,[
  //     'Name'=>'required',
  //     'Name_class_en'=>'required'
  //   ]
  // ,[
  //   'Name.required'=>trans('validation.required'),
  //   'Name_class_en.required'=>trans('validation.required')
  // ]);
   $list_class=$request->List_Classes;
  try{
   
    foreach($list_class as $list){
      $My_Classes= new Classroom();
      $My_Classes->Name_Class = ['en'=>$list['Name_class_en'],'ar'=>$list['Name']];
      $My_Classes->Grade_id =$list['Grade_id'];
      $My_Classes->save();
    }
   
  
   return redirect()->route('Classrooms.index');
  }
  catch(\Exception $e){
    return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
  }

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
  public function update(Request $request,$id)
  {
    $My_Classes=Classroom::findOrFail($id);
    $My_Classes->Name_Class=[
        'en' => $request->Name_en,
        'ar' => $request->Name,
    ];
    $My_Classes->Grade_id=$request->Grade_id;
    $My_Classes->save();
    return redirect()->route('Classrooms.index');
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    Classroom::destroy($id);
    return redirect()->route('Classrooms.index');
  }
  
}

?>
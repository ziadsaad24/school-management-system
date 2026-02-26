<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use DB;


class FeeinvoicesRepository implements FeeinvoicesRepositoryInterface 
{
    // Implement method signatures defined in FeeinvoicesRepositoryInterface here
    public function index()
    {
        $Fee_invoices= Fee_invoice::all();
        $Grades= Grade::all();
        return view('pages.Fees_invoices.index',compact('Fee_invoices','Grades'));   // Implementation of index method
    }
    public function show($id)
    {
       $student =Student::findOrFail($id);
       $fees= Fee::where('Classroom_id',$student->Classroom_id)->get();
         return view('pages.Fees_invoices.add',compact('student','fees'));
    }
    public function store($request){
        $List_Fees=$request->List_Fees;
        DB::beginTransaction();
        try{
            foreach($List_Fees as $List_fee){
                $fees = new Fee_invoice();
                $fees->invoice_date= date('Y-m-d');
                $fees->student_id=$List_fee['student_id'];
                $fees->fee_id=$List_fee['fee_id'];
                $fees->amount=$List_fee['amount'];
                $fees->description=$List_fee['description'];
                $fees->Grade_id=$request->Grade_id;
                $fees->Classroom_id=$request->Classroom_id;
                $fees->save();

                // احنا عملنا الجريد والكلاس مش من ضمن الليست في عشان اصلا احنا معملنهاش فيها بناخدها مره واحده
                // دي عشان عمليه الادراج المتكرر بحيث اني باخد كذا قيمه ف نفس الوقت
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
                $StudentAccount->fee_invoice_id = $fees->id;
                $StudentAccount->student_id = $List_fee['student_id'];
                $StudentAccount->Debit = $List_fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_fee['description'];
                $StudentAccount->save();
            }
            DB::commit();
            return redirect()->route('Fees_invoices.index')->with('success', 'تمت اضافة الفاتورة بنجاح');
        }
        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id){
        $fee_invoices= Fee_invoice::findOrFail($id);
        $fees=Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.Fees_invoices.edit',compact('fee_invoices','fees'));
    }
    public function update($request){
        DB::beginTransaction();
        try{
            {
                $fees = Fee_invoice::findOrFail($request->id);
                $fees->fee_id=$request->fee_id;
                $fees->amount=$request->amount;
                $fees->description=$request->description;
                $fees->save();

                // احنا عملنا الجريد والكلاس مش من ضمن الليست في عشان اصلا احنا معملنهاش فيها بناخدها مره واحده
                // دي عشان عمليه الادراج المتكرر بحيث اني باخد كذا قيمه ف نفس الوقت
                $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
                
               
                $StudentAccount->Debit = $request->amount;
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $request->description;
                $StudentAccount->save();
            }
            DB::commit();
            return redirect()->route('Fees_invoices.index')->with('success', 'تمت تعديل الفاتورة بنجاح');
        }
        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request){
        DB::beginTransaction();
        try{
            Fee_invoice::destroy($request->id);
            StudentAccount::where('fee_invoice_id',$request->id)->delete();
            DB::commit();
            return redirect()->route('Fees_invoices.index')->with('success', 'تم حذف الفاتورة بنجاح');
}
        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
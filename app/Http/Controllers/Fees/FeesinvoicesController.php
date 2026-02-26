<?php

namespace App\Http\Controllers\Fees;
use App\Http\Controllers\Controller;
use App\Repository\FeeinvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeesinvoicesController extends Controller
{
    protected $Fees_invoices;
    public function __construct(FeeinvoicesRepositoryInterface $Fees_invoices){
        $this->Fees_invoices= $Fees_invoices;
    }
      public function index()
    {
      return $this->Fees_invoices->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       // return $this->Feesinvoices->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       return $this->Fees_invoices->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Fees_invoices->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       return $this->Fees_invoices->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
       return $this->Fees_invoices->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Fees_invoices->destroy($request);
    }
}


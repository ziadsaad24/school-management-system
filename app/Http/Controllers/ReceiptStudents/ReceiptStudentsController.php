<?php

namespace App\Http\Controllers\ReceiptStudents;
use App\Http\Controllers\Controller;
use App\Repository\ReceiptRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentsController extends Controller
{
    protected $Receipt;
    public function __construct(ReceiptRepositoryInterface $Receipt){
        $this->Receipt=$Receipt;
    }
    public function index()
    {
        return $this->Receipt->index();
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
    public function store(Request $request)
    {
        return $this->Receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Receipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($request)
    {
         return $this->Receipt->destroy($request);
    }
}

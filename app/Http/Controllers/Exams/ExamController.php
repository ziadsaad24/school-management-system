<?php

namespace App\Http\Controllers\Exams;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Repository\ExamRepositoryInterface;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected $exam;
    public function __construct(ExamRepositoryInterface $exam)
    {
        $this->exam=$exam;
    }
    public function index()
    {
        return $this->exam->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->exam->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->exam->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->exam->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->exam->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->exam->destroy($request);
    }
}

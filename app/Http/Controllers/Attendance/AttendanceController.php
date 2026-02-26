<?php

namespace App\Http\Controllers\Attendance;
use App\Http\Controllers\Controller;

use App\Models\Attendance;
use App\Repository\AttendanceRepositoryInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $Attendance;
    public function __construct(AttendanceRepositoryInterface $Attendance){
        $this->Attendance= $Attendance;
    }
    public function index()
    {
        return $this->Attendance->index();
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
        return $this->Attendance->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Attendance->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Attendance->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($request): void
    {
        return $this->Attendance->destroy($request);
    }
}

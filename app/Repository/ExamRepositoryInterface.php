<?php

namespace App\Repository;

interface ExamRepositoryInterface
{
    //interface methods here
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);

}
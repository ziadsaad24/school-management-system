<?php


namespace App\Repository;

interface FeesRepositoryInterface 
{
    // Define method signatures for Fees repository here
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);
}

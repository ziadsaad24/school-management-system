<?php

namespace App\Repository;




Interface ReceiptRepositoryInterface{
    public function index();
    public function show($id);
    public function store($request);
    public function destroy($request);
    public function update($request);
    public function edit($id);


}
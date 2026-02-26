<?php

namespace App\Repository;



interface GraduatedRepositoryInterface 
{
    public function index();
  
    public function create();
    public function softDelete($request);
    public function Returndata($request);
    public function Delete($request);
    public function Delete_one($request);
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function student(){
        $this->belongsTo(Student::class,'student_id');
    }
}

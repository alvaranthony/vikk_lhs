<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ExamType extends Model
{
    protected $table = 'exam_types';
    
    public function user(){
        return $this->belongsToMany('App\User', 'exam_user');
    }
}

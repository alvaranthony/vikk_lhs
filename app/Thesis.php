<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class Thesis extends Model
{
    protected $table = 'theses';
    
    public function student(){
        return $this->belongsTo('App\Student');
    }
}

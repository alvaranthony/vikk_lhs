<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class FileEntry extends Model
{
    protected $table = 'fileentries';
    
    public function student(){
        return $this->belongsTo('App\Student');
    }
}

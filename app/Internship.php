<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Internship extends Model
{
    protected $table = "internships";
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}

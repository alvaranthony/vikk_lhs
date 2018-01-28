<?php

namespace App;
use App\User;
use App\Thesis;
use App\Role;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = "relations";
    public $timestamps = false;
    
    
    public function user(){
        return $this->belongsToMany('App\User');
    }
    
    public function thesis(){
        return $this->belongsToMany('App\Thesis');
    }
    
    public function role(){
        return $this->belongsToMany('App\Role');
    }
}

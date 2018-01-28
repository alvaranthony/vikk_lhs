<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Thesis;
use App\Relation;

class Role extends Model
{
    protected $table = "roles";
    
    //modified
    
    public function user(){
        return $this->belongsToMany('App\User', 'roles_theses_users')->withPivot('thesis_id');
    }
    
    public function thesis(){
        return $this->belongsToMany('App\Thesis', 'roles_theses_users')->withPivot('user_id');
    }
    
    #public function relations(){
    #    return $this->hasMany('App\Relation', 'relations');
    #}
}

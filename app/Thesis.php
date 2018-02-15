<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use App\FileEntry;
use App\Relation;
use App\Status;

class Thesis extends Model
{
    protected $table = 'theses';
    
    //modified
    
    public function user(){
        return $this->belongsToMany('App\User', 'roles_theses_users')->withPivot('role_id');
    }
    
    public function role(){
        return $this->belongsToMany('App\Role', 'roles_theses_users')->withPivot('user_id');
    }
    
     public function fileentry(){
        return $this->hasMany('App\FileEntry');
    }
    
    public function status(){
        return $this->belongsTo('App\Status');
    }
    
    #public function relations(){
    #    return $this->hasMany('App\Relation', 'relations');
    #}
}

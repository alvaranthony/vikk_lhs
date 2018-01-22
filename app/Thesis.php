<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;
use App\FileEntry;
use App\Relation;

class Thesis extends Model
{
    protected $table = 'theses';
    
    public function fileentry(){
        return $this->hasMany('App\FileEntry');
    }
    
    //modified
    
    public function user(){
        return $this->belongsToMany('App\User', 'roles_theses_users')->withPivot('role_id');
    }
    
    public function role(){
        return $this->belongsToMany('App\Role', 'roles_theses_users')->withPivot('user_id');
    }
    
    
    #public function relation(){
    #    return $this->hasMany('App\Relation', 'relations');
    #}
}

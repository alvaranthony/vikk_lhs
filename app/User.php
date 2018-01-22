<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Thesis;
use App\Internship;
use App\Role;
use App\Relation;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'id_code', 'phone_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function internship(){
        return $this->hasMany('App\Internship');
    }
    
    //modified
    
    public function thesis(){
        return $this->belongsToMany('App\Thesis', 'roles_theses_users')->withPivot('role_id');
    }
    
    public function role(){
        return $this->belongsToMany('App\Role', 'roles_theses_users')->withPivot('thesis_id');
    }
    
    
    #public function relation(){
    #    return $this->hasMany('App\Relation', 'relations');
    #}
}

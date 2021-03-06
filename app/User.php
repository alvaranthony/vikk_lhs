<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\ExamLanguage;
use App\Internship;
use App\ExamType;
use App\Relation;
use App\Thesis;
use App\Group;
use App\Exam;
use App\Role;


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
    
    public function group(){
        return $this->belongsTo('App\Group');
    }
    
    public function exam_lang(){
        return $this->belongsTo('App\ExamLanguage');
    }
    
    public function exam_type(){
        return $this->belongsToMany('App\ExamType', 'exam_user');
    }
    
    public function instructorTheses () {
        return $this->thesis()->wherePivot('role_id', 3);
    }
    
    public function reviewerTheses () {
        return $this->thesis()->wherePivot('role_id', 8);
    }
    
    public function hasRole($name)
    {
        foreach ($this->role as $role) 
        {
            if ($role->name == $name) return true;
        }
        
        return false;
    }
}

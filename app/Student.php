<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use App\Thesis;
use App\FileEntry;
use App\Internship;

class Student extends Authenticatable
{
    use Notifiable;

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
    
    protected $table = 'students';
    
    public function thesis(){
        return $this->hasOne('App\Thesis');
    }
    
   public function fileentry(){
        return $this->hasOne('App\FileEntry');
    }
    
    public function internship(){
        return $this->hasMany('App\Internship');
    }
}

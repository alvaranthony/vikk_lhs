<?php

namespace App;
use App\Group;
use App\Thesis;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    
    public function thesis(){
        return $this->hasMany('App\Thesis');
    }
}

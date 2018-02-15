<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thesis;

class Status extends Model
{
    protected $table = "statuses";
    public $timestamps = false;
    
    public function theses(){
        return $this->hasMany('App\Thesis');
    }
}

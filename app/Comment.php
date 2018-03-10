<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function users(){
    	return $this->hasMany(User::class);
    }
}

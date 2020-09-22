<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taskcat extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function measurementunit()
    {
    	return $this->belongsTo(Measurementunit::class);
    }

    public function procurementcat()
    {
    	return $this->belongsTo(Procurementcat::class);
    }
}

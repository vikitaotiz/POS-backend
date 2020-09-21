<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procurementcat extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function procurements()
    {
        return $this->hasMany(Procurement::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function table()
    {
    	return $this->belongsTo(Table::class);
    }
}

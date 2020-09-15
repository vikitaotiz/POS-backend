<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmedrequest extends Model
{
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function provider()
    {
    	return $this->belongsTo(Provider::class);
    }

    public function paymentmode()
    {
    	return $this->belongsTo(Paymentmode::class);
    }
}

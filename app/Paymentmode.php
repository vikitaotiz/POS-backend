<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymentmode extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function confirmedrequests()
    {
        return $this->hasMany(Confirmedrequest::class);
    }
}

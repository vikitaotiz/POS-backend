<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expensecat()
    {
        return $this->belongsTo(Expensecat::class);
    }

    public function measurementunit()
    {
        return $this->belongsTo(Measurementunit::class);
    }

    public function paymentmode()
    {
        return $this->belongsTo(Paymentmode::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}

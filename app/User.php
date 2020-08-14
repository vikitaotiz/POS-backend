<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'department_id', 'role_id', 'pwd_clr', 'pin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $hidden = [
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function drinks()
    {
        return $this->hasMany(Drink::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function duplicatesales()
    {
        return $this->hasMany(Duplicatesale::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function picks()
    {
        return $this->hasMany(Pick::class);
    }

    public function readies()
    {
        return $this->hasMany(Ready::class);
    }

    public function adds()
    {
        return $this->hasMany(Add::class);
    }

    public function adddrinks()
    {
        return $this->hasMany(Adddrink::class);
    }

    public function addpicks()
    {
        return $this->hasMany(Addpick::class);
    }

    public function cancels()
    {
        return $this->hasMany(Cancel::class);
    }

    public function loggers()
    {
        return $this->hasMany(Logger::class);
    }

    public function addons()
    {
        return $this->hasMany(Addon::class);
    }

    public function bills()
    {
        return $this->hasMany(Addon::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function expensecats()
    {
        return $this->hasMany(Expensecat::class);
    }

    public function measurementunits()
    {
        return $this->hasMany(Measurementunit::class);
    }

    public function paymentmodes()
    {
        return $this->hasMany(Paymentmode::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}

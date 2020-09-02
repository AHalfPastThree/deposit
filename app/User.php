<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'id',
    ];

    public function getAuthPassword()
    {
        return Hash::make(request()->get('password'));
    }

    public function wallet()
    {
        return $this->hasOne('App\Wallets');
    }

    public function deposit()
    {
        return $this->hasOne('App\Deposits');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transactions');
    }
}

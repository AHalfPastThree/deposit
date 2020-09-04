<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
	protected $table = 'wallets';

	protected $fillable = [
        'user_id', 'balance',
    ];

    public $timestamps = false;

    public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function deposit()
    {
        return $this->hasOne('App\Deposits', 'wallet_id');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transactions');
    }
}

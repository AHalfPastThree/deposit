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
		return $this->belongsTo('App\User', 'foreign_key');
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

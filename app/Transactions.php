<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
	protected $table = 'transactions';

    public $timestamps = false;

    protected $fillable = [
        'type', 'user_id', 'wallet_id', 'deposit_id', 'amount',
    ];

    public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function wallet()
	{
		return $this->belongsTo('App\User', 'wallet_id');
	}

	public function deposit()
	{
		return $this->belongsTo('App\Deposits');
	}
}
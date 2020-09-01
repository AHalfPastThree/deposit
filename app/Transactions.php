<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
	protected $table = 'transactions';

    public $timestamps = false;

    public function user()
	{
		return $this->belongsTo('App\User', 'foreign_key');
	}

	public function wallet()
	{
		return $this->belongsTo('App\User', 'foreign_key');
	}

	public function deposit()
	{
		return $this->belongsTo('App\Deposits', 'foreign_key');
	}
}

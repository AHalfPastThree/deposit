<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
	protected $table = 'deposits';

    public $timestamps = false;

    protected $fillable = [
        'user_id', 
        'wallet_id', 
        'invested', 
        'percent', 
        'active', 
        'duration', 
        'accrue_times',
    ];


    public function user()
	{
		return $this->belongsTo('App\User', 'foreign_key');
	}

	public function wallet()
	{
		return $this->belongsTo('App\Wallets', 'foreign_key');
	}

	public function transactions()
    {
        return $this->hasMany('App\Deposits');
    }
}

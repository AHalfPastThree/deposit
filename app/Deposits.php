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
		return $this->belongsTo('App\User', 'user_id');
	}

	public function wallet()
	{
		return $this->belongsTo('App\Wallets', 'wallet_id');
	}

	public function transactions()
    {
        return $this->hasMany('App\Transactions', 'deposit_id');
    }

    public function sum()
	{
        $sum = 0;
		foreach($this->transactions as $transaction){
            if($transaction->type != 'create_deposit'){
                $sum = $sum + $transaction->amount;
            }
        }
        return $sum;
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposits;
use App\Transactions;

class DepositController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function add(Request $request)
    {
    	$user = $request->user();

    	if ($request->input('deposite') <= $user->wallet->balance && !$user->deposit) {
    		$deposit = Deposits::create([
	    		'user_id' => $user->id,
	    		'wallet_id' => $user->wallet->id,
	    		'invested' => floatval($request->input('deposit')),
	    		'percent' => 20,
	    		'active' => 1,
	    		'duration' => 6000,
	    		'accrue_times' => 10
	    	]);
	    	if ($deposit) {
	    		$user->wallet->balance = $user->wallet->balance - floatval($request->input('deposit'));
	    		Transactions::create([
		    		'type' => 'create_deposit',
		    		'user_id' => $user->id,
		    		'wallet_id' => $user->wallet->id,
		    		'deposit_id' => $deposit->id,
		    		'amount' => floatval($request->input('deposit')),
		    	]);
	    	}
    	}

    	return redirect()->back();
    }
}

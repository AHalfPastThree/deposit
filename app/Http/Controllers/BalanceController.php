<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallets;
use App\Deposits;
use App\Transactions;

class BalanceController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
	}
	
	/**
     * Add entered points to user balance
     *
     * @return float
     */
    public function add(Request $request)
    {
    	$user = $request->user();

		$user->wallet->update(['balance' => floatval($user->wallet->balance) + floatval($request->input('balance'))]);

    	Transactions::create([
    		'type' => 'enter',
    		'user_id' => $user->id,
    		'wallet_id' => $user->wallet->id,
    		'deposit_id' => $user->wallet->deposit_id ? $user->wallet->deposit_id : null,
    		'amount' => floatval($request->input('balance')),
    	]);

    	return redirect()->back();
    }
}

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

    public function add(Request $request)
    {
    	$user_id = $request->user()->id;

		$wallet = Wallets::where('user_id', $user_id)->first();
		$wallet->balance = floatval($wallet->balance) + floatval($request->input('balance'));
		$wallet->save();

		$deposite = $wallet->deposit();

    	Transactions::create([
    		'type' => 'enter',
    		'user_id' => $user_id,
    		'wallet_id' => $wallet->id,
    		'deposit_id' => $deposite ? $deposite->id : null,
    		'amount' => $request->input('balance'),
    	]);

    	return redirect()->back();
    }
}

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

	/**
     * Add new deposit
     *
     * @return void
     */
    public function add(Request $request)
    {
    	$user = $request->user();

    	if ($request->input('deposit') <= $user->wallet->balance && $request->input('deposit') >= 10 && $request->input('deposit') <= 100 && !$user->deposit() || $user->deposit()->active != 1) {
			$deposit = Deposits::create([
				'user_id' => $user->id,
				'wallet_id' => $user->wallet->id,
				'invested' => floatval($request->input('deposit')),
				'percent' => 20,
				'active' => 1,
				'duration' => 0,
				'accrue_times' => 10
			]);
			if($deposit){
				$user->wallet->update(['balance' => $user->wallet->balance - floatval($request->input('deposit'))]);
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

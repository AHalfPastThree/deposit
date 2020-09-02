<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallets;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()) {
            $user = $request->user()->id;
            $user_wallet = Wallets::where('user_id', $user)->first();
        }else{
            $user_wallet['balance'] = null;
        }

        return view('home')->with([
            'balance' => $user_wallet['balance']
        ]);
    }
}

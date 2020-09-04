<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallets;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('home')->with([
            'balance' => $user ? $user->wallet->balance : null,
            'deposits' => $user ? $user->deposits : null,
            'transactions' => $user ? $user->transactions : null
        ]);
    }
}

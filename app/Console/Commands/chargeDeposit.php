<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Transactions;

class chargeDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charge:deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adding a percent to deposit in a setting time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach($users as $user){
            if($user->deposit() && $user->deposit()->active == 1){
                $user->wallet->update(['balance' => $user->wallet->balance + $user->deposit()->invested/100*$user->deposit()->percent]);
                $user->deposit()->update(['duration' =>  $user->deposit()->duration + 1]);
                $type = $user->deposit()->duration != $user->deposit()->accrue_times ? 'accrue' : 'close_deposit';
                $transaction = Transactions::create([
                    'type' => $type,
                    'user_id' => $user->id,
                    'wallet_id' => $user->wallet->id,
                    'deposit_id' => $user->deposit()->id,
                    'amount' => $user->deposit()->invested/100*$user->deposit()->percent,
                ]);
                if($transaction->type == 'close_deposit'){
                    $user->deposit()->update(['active' => 0]);
                }
            }    
        }
    }
}

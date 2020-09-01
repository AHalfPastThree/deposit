<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('deposit.public.users')->onDelete('cascade');
            $table->integer('wallet_id')->unsigned();
            $table->foreign('wallet_id')->references('id')->on('deposit.public.wallets')->onDelete('cascade');
            $table->double('invested', 0);
            $table->double('percent', 0);
            $table->smallInteger('active', 0);
            $table->smallInteger('duration', 0);
            $table->smallInteger('accrue_times', 0);
            $table->timestamp('created_at', 0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}

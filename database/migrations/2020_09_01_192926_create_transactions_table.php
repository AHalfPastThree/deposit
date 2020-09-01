<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 30);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('deposit.public.users')->onDelete('cascade');
            $table->integer('wallet_id')->unsigned();
            $table->foreign('wallet_id')->references('id')->on('deposit.public.wallets')->onDelete('cascade');
            $table->integer('deposit_id')->nullable()->unsigned();
            $table->foreign('deposit_id')->references('id')->on('deposit.public.deposits')->onDelete('cascade');
            $table->double('amount', 0);
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
        Schema::dropIfExists('transactions');
    }
}

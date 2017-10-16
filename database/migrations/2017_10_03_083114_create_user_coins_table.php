<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_coins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coin_list_id')->unsigned();
            $table->foreign('coin_list_id')->references('id')->on('coin_lists');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('transaction_type', 50);
            $table->string('current_price', 100);
            $table->string('trade_price_usd', 100);
            $table->string('quantity', 20);
            $table->string('total_value_usd', 100);
            $table->date('trade_date');
            $table->text('notes');
            $table->string('chip_value', 100)->nullable();
            $table->string('trade_type', 50)->nullable();
            $table->string('target_1', 100)->nullable();
            $table->string('target_2', 100)->nullable();
            $table->string('target_3', 100)->nullable();
            $table->string('status', 1)->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_coins');
    }
}

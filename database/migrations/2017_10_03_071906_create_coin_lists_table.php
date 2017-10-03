<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('coin_id')->unique();
            $table->text('url');
            $table->text('image_url');
            $table->string('name');
            $table->string('coin_name');
            $table->string('full_name');
            $table->string('algorithm');
            $table->string('proof_type');
            $table->string('fully_premined');
            $table->string('total_coin_supply');
            $table->string('pre_mined_value');
            $table->string('total_coins_free_float');
            $table->string('sort_order');
            $table->boolean('sponsored');
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
        Schema::dropIfExists('coin_lists');
    }
}

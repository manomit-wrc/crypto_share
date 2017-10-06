<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToUserCoins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_coins', function (Blueprint $table) {
            $table->string('close',50)->after('trade_type')->nullable();
            $table->string('high',50)->after('close')->nullable();
            $table->string('low',50)->after('high')->nullable();
            $table->string('open',50)->after('low')->nullable();
            $table->string('volumefrom',50)->after('open')->nullable();
            $table->string('volumeto',50)->after('volumefrom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_coins', function (Blueprint $table) {
            //
        });
    }
}

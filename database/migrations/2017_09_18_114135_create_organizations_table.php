<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('address');
            $table->integer('country_id')->unsigned();
            $table->string('state_name', 100);
            $table->string('city_name', 100);
            $table->string('pincode', 20);
            $table->string('email', 150);
            $table->string('phone_no', 100);
            $table->text('facebook');
            $table->text('twitter');
            $table->text('linkedin');
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
        Schema::dropIfExists('organizations');
    }
}

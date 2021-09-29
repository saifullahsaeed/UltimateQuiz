<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email_or_phone')->unique();
            $table->string('password')->nullable();
            $table->integer('actual_score');
            $table->integer('total_score');
            $table->string('image_url');
            $table->string('referral_code')->unique();
            $table->integer('coins');
            $table->dateTime('last_claim')->nullable();
            $table->string('login_method');
            $table->string('device_id')->unique();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->float('earnings_withdrawed');
            $table->float('earnings_actual');
            $table->string('blocked');
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
        Schema::dropIfExists('players');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            $table->string('api_secret_key');
            $table->integer('min_to_withdraw');
            $table->integer('conversion_rate');
            $table->integer('hint_coins');
            $table->integer('referral_register_points');
            $table->integer('remove_letter_coins');
            $table->integer('video_ad_coins');
            $table->integer('daily_reward');
            $table->string('lang');
            $table->string('earning_system');
            $table->string('one_device');
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
        Schema::dropIfExists('settings');
    }
}

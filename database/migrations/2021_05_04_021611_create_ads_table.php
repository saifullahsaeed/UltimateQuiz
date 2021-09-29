<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('admob_app_id')->nullable();
            $table->string('admob_banner')->nullable();
            $table->string('admob_interstitial')->nullable();
            $table->string('admob_native')->nullable();
            $table->string('admob_reward')->nullable();
            $table->string('facebook_banner')->nullable();
            $table->string('facebook_interstitial')->nullable();
            $table->string('facebook_native')->nullable();
            $table->string('facebook_reward')->nullable();
            $table->string('adcolony_app_id')->nullable();
            $table->string('adcolony_banner')->nullable();
            $table->string('adcolony_interstitial')->nullable();
            $table->string('adcolony_reward')->nullable();
            $table->string('startapp_app_id')->nullable();
            $table->string('startapp_banner')->nullable();
            $table->string('startapp_interstitial')->nullable();
            $table->string('startapp_reward')->nullable();
            $table->string('banner_type');
            $table->string('interstitial_type');
            $table->string('video_type');
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
        Schema::dropIfExists('ads');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContinuequizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continuequizzes', function (Blueprint $table) {
            $table->id();
            $table->integer('quiz_id');
            $table->string('quiz_name');
            $table->string('quiz_image_url');
            $table->integer('subcategory_id');
            $table->integer('category_id');
            $table->integer('player_id');
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
        Schema::dropIfExists('continuequizzes');
    }
}

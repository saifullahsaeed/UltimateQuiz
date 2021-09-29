<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletedquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completedquestions', function (Blueprint $table) {
            $table->id();
            $table->integer('question_id');
            $table->integer('player_id');
            $table->integer('quiz_id');
            $table->integer('subcategory_id');
            $table->integer('category_id');
            $table->integer('points');
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
        Schema::dropIfExists('completedquestions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('quiz_id');
            $table->integer('points');
            $table->integer('seconds');
            $table->text('hint');
            $table->text('true_answer');
            $table->text('false1');
            $table->text('false2');
            $table->text('false3');
            $table->text('question_text');
            $table->string('premium_or_not');
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
        Schema::dropIfExists('text_questions');
    }
}

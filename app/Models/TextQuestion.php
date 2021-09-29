<?php

namespace App\Models;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'subcategory_id', 'quiz_id', 'points','seconds', 'hint', 'true_answer', 'false1', 'false2', 'false3', 'question_text', 'premium_or_not'];

    public function quiz() {
    	return $this->belongsTo(Quiz::class);
    }
}

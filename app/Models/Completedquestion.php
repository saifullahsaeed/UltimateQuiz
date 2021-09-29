<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completedquestion extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'player_id', 'quiz_id', 'subcategory_id', 'category_id','points', 'question_type'];

    public function player() {
    	return $this->belongsTo(Player::class);
    }
}

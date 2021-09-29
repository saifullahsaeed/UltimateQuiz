<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continuequiz extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'quiz_name', 'quiz_image_url', 'subcategory_id', 'category_id', 'player_id'];

    public function player() {
    	return $this->belongsTo(Player::class);
    }
}

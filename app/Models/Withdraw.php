<?php

namespace App\Models;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = ['player_id', 'player_email', 'amount', 'points', 'status', 'payment_method', 'payment_info'];

    public function player() {
    	return $this->belongsTo(Player::class);
    }
}

<?php

namespace App\Models;

use App\Models\Completedquestion;
use App\Models\Continuequiz;
use App\Models\Withdraw;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'email_or_phone', 'password', 'actual_score', 'total_score', 'image_url', 'referral_code', 'coins', 'last_claim', 'login_method', 'device_id', 'facebook', 'twitter', 'instagram', 'earnings_withdrawed', 'earnings_actual', 'blocked'];

    public function continuequizzes() {
    	return $this->hasMany(Continuequiz::class);
    }

    public function completedquestions() {
    	return $this->hasMany(Completedquestion::class);
    }

    public function withdraws() {
    	return $this->hasMany(Withdraw::class);
    }
}

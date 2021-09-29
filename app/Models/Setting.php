<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    
    protected $fillable = ['currency', 'completed_option', 'api_secret_key', 'min_to_withdraw', 'conversion_rate', 'hint_coins', 'referral_register_points', 'video_ad_coins', 'daily_reward', 'lang', 'one_device', 'fifty_fifty'];
}

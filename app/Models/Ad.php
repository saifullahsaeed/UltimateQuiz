<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['admob_app_id', 'admob_banner', 'admob_interstitial', 'admob_native', 'admob_reward', 'facebook_banner', 'facebook_interstitial', 'facebook_native', 'facebook_reward', 'adcolony_app_id', 'adcolony_banner', 'adcolony_interstitial', 'adcolony_reward', 'startapp_app_id', 'banner_type', 'interstitial_type', 'video_type'];
}

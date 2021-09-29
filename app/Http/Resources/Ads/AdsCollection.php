<?php

namespace App\Http\Resources\Ads;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class AdsCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id'=>$this->id,
        'admob_app_id'=>$this->admob_app_id,
        'admob_banner'=>$this->admob_banner,
        'admob_interstitial'=>$this->admob_interstitial,
        'admob_native'=>$this->admob_native,
        'admob_reward'=>$this->admob_reward,
        'facebook_banner'=>$this->facebook_banner,
        'facebook_interstitial'=>$this->facebook_interstitial,
        'facebook_native'=>$this->facebook_native,
        'facebook_reward'=>$this->facebook_reward,
        'adcolony_app_id'=>$this->adcolony_app_id,
        'adcolony_banner'=>$this->adcolony_banner,
        'adcolony_interstitial'=>$this->adcolony_interstitial,
        'adcolony_reward'=>$this->adcolony_reward,
        'startapp_app_id'=>$this->startapp_app_id,
        'startapp_interstitial'=>$this->startapp_interstitial,
        'startapp_reward'=>$this->startapp_reward,
        'startapp_banner'=>$this->startapp_banner,
        'banner_type'=>$this->banner_type,
        'interstitial_type'=>$this->interstitial_type,
        'video_type'=>$this->video_type,
        'lang'=>Setting::find(1)->lang,
        'daily_reward'=>Setting::find(1)->daily_reward,
        ];
    }
}

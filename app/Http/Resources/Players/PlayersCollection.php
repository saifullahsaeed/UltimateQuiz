<?php

namespace App\Http\Resources\Players;

use App\Models\Refer;
use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayersCollection extends JsonResource
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
        'username'=>$this->username,
        'email_or_phone'=>$this->email_or_phone,
        'actual_score'=>$this->actual_score,
        'total_score'=>$this->total_score,
        'image_url'=>$this->image_url,
        'referral_code'=>$this->referral_code,
        'coins'=>$this->coins,
        'last_claim'=>$this->last_claim,
        'login_method'=>$this->login_method,
        'device_id'=>$this->device_id,
        'facebook'=>$this->facebook,
        'twitter'=>$this->twitter,
        'instagram'=>$this->instagram,
        'earnings_withdrawed'=>$this->earnings_withdrawed,
        'earnings_actual'=>$this->earnings_actual,
        'earnings_actual_with_currency'=>Setting::find(1)->currency. " " . $this->earnings_actual,
        'min_to_withdraw'=>Setting::find(1)->currency. " " .Setting::find(1)->min_to_withdraw,
        'min_to_withdraw_double'=>Setting::find(1)->min_to_withdraw,
        'blocked'=>$this->blocked,
        'currency'=>Setting::find(1)->currency,
        'hint_coins'=>Setting::find(1)->hint_coins,
        'fifty_fifty'=>Setting::find(1)->fifty_fifty,
        'video_ad_coins'=>Setting::find(1)->video_ad_coins,
        'referrals'=>Refer::where('referred_source_id', '=' ,$this->id)->count(),
        'member_since'=>$this->created_at->format('jS F Y')];
    }
}

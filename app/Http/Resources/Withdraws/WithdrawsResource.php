<?php

namespace App\Http\Resources\Withdraws;

use App\Models\Setting;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id'=>$this->id,
        'player_id'=>$this->player_id,
        'player_email'=>$this->player_email,
        'amount'=>$this->amount . " " . Setting::find(1)->currency,
        'points'=>$this->points,
        'status'=>$this->status,
        'payment_method'=>$this->payment_method,
        'payment_info'=>$this->payment_info,
        'date'=>$this->created_at->format('jS F Y')
        ];
    }
}

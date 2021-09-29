<?php

namespace App\Http\Resources\Refers;

use App\Models\Player;
use Illuminate\Http\Resources\Json\JsonResource;

class RefersCollection extends JsonResource
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
        'player_id'=>$this->player_id,
        'player_email'=>$this->player_email,
        'player_username'=>Player::find($this->player_id)->username,
        'player_image'=>Player::find($this->player_id)->image_url,
        'referred_source_id'=>$this->referred_source_id,
        'date'=>$this->created_at->format('jS F Y')
        ];
    }
}

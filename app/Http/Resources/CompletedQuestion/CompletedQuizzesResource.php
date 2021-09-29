<?php

namespace App\Http\Resources\CompletedQuestion;

use App\Models\AudioQuestion;
use App\Models\ImageQuestion;
use App\Models\TextQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class CompletedQuizzesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {         
        $return_array = [
            'id'=>$this->id,
        'question_id'=>$this->question_id,
        'player_id'=>$this->player_id,
        'quiz_id'=>$this->quiz_id,
        'subcategory_id'=>$this->subcategory_id,
        'category_id'=>$this->category_id,
        'points'=>$this->points,
        'question_type'=>$this->question_type,
        'date'=>$this->created_at->format('jS F Y')];
    if ($this->question_type=="text") {
            $return_array['true_answer']=TextQuestion::find($this->question_id)->true_answer;
        } elseif ($this->question_type=="image") {
            $return_array['true_answer']=ImageQuestion::find($this->question_id)->true_answer;
        } elseif ($this->question_type=="audio") {
            $return_array['true_answer']=AudioQuestion::find($this->question_id)->true_answer;
        }
    return $return_array;
}
}

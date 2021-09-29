<?php

namespace App\Http\Resources\ContinueQuizzes;

use App\Models\AudioQuestion;
use App\Models\Category;
use App\Models\Completedquestion;
use App\Models\ImageQuestion;
use App\Models\Subcategory;
use App\Models\TextQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class ContinueQuizzesCollection extends JsonResource
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
        'quiz_id'=>$this->quiz_id,
        'audio_questions'=>AudioQuestion::where('quiz_id', '=', $this->quiz_id)->count(),
        'text_questions'=>TextQuestion::where('quiz_id', '=', $this->quiz_id)->count(),
        'image_questions'=>ImageQuestion::where('quiz_id', '=', $this->quiz_id)->count(),
        'quiz_name'=>$this->quiz_name,
        'quiz_image_url'=>$this->quiz_image_url,
        'subcategory_id'=>$this->subcategory_id,
        'subcategory_name'=>Subcategory::find($this->subcategory_id)->name,
        'category_id'=>$this->category_id,
        'category_name'=>Category::find($this->category_id)->category_name,
        'player_id'=>$this->player_id,
        'created_at'=>$this->created_at->format('jS F Y'),
        'quiz_number_of_questions'=>TextQuestion::where('quiz_id', '=', $this->quiz_id)->count() + ImageQuestion::where('quiz_id', '=', $this->quiz_id)->count() + AudioQuestion::where('quiz_id', '=', $this->quiz_id)->count(),
        'quiz_number_of_completed_questions'=>Completedquestion::where([
            'quiz_id'=>$this->quiz_id,
            'player_id'=>$this->player_id])->get()->count(),
        'quiz_number_of_remaining_questions'=>TextQuestion::where('quiz_id', '=', $this->quiz_id)->count() + ImageQuestion::where('quiz_id', '=', $this->quiz_id)->count() + AudioQuestion::where('quiz_id', '=', $this->quiz_id)->count() - Completedquestion::where([
            'quiz_id'=>$this->quiz_id,
            'player_id'=>$this->player_id])->get()->count(),
        ];
    }
}

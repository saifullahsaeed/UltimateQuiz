<?php

namespace App\Http\Resources\Quizzes;

use App\Models\AudioQuestion;
use App\Models\Category;
use App\Models\ImageQuestion;
use App\Models\Subcategory;
use App\Models\TextQuestion;
use Illuminate\Http\Resources\Json\JsonResource;

class QuizzesCollection extends JsonResource
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
        'quiz_name'=>$this->name,
        'quiz_image_url'=>$this->image_url,
        'subcategory_id'=>$this->subcategory_id,
        'subcategory_name'=>Subcategory::find($this->subcategory_id)->name,
        'category_id'=>$this->category_id,
        'category_name'=>Category::find($this->category_id)->category_name,
        'created_at'=>$this->created_at->format('jS F Y'),
        'quiz_number_of_questions'=>TextQuestion::where('quiz_id', '=', $this->id)->count() + ImageQuestion::where('quiz_id', '=', $this->id)->count() + AudioQuestion::where('quiz_id', '=', $this->id)->count(),
        'quiz_number_of_text_questions'=>TextQuestion::where('quiz_id', '=', $this->id)->count(),
        'quiz_number_of_image_questions'=>ImageQuestion::where('quiz_id', '=', $this->id)->count(),
        'quiz_number_of_audio_questions'=>AudioQuestion::where('quiz_id', '=', $this->id)->count(),
        ];
    }
}

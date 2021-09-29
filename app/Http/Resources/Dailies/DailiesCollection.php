<?php

namespace App\Http\Resources\Dailies;

use App\Models\Category;
use App\Models\Question;
use App\Models\Subcategory;
use Illuminate\Http\Resources\Json\JsonResource;

class DailiesCollection extends JsonResource
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
        'daily_name'=>$this->name,
        'daily_image_url'=>$this->image_url,
        'subcategory_id'=>$this->subcategory_id,
        'subcategory_name'=>Subcategory::find($this->subcategory_id)->name,
        'category_id'=>$this->category_id,
        'category_name'=>Category::find($this->category_id)->category_name,
        'quiz_id'=>$this->quiz_id,
        'quiz_name'=>Quiz::find($this->quiz_id)->name,
        'created_at'=>$this->created_at->format('jS F Y'),
        'text_questions'=>TextQuestion::where('quiz_id', '=', $this->quiz_id)->count(),
        'image_questions'=>ImageQuestion::where('quiz_id', '=', $this->quiz_id)->count(),
        'audio_questions'=>AudioQuestion::where('quiz_id', '=', $this->quiz_id)->count(),
        ];
    }
}

<?php

namespace App\Http\Resources\Subcategories;

use App\Models\Quiz;
use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoriesCollection extends JsonResource
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
        'subcategory_name'=>$this->name,
        'subcategory_img'=>$this->image_url,
        'number_of_quizzes'=>Quiz::where('subcategory_id', '=', $this->id)->count()];
    }
}

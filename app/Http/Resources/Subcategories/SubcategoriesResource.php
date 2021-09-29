<?php

namespace App\Http\Resources\Subcategories;

use App\Models\Quiz;
use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoriesResource extends JsonResource
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
        'subcategory_name'=>$this->name,
        'subcategory_img'=>$this->image_url,
        'number_of_quizzes'=>Quiz::where('subcategory_id', '=', $this->id)->count()];
    }
}

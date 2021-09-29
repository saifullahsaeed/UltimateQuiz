<?php

namespace App\Http\Resources\Categories;

use App\Models\Quiz;
use App\Models\Subcategory;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
        'category_name'=>$this->category_name,
        'category_img'=>$this->category_img,
        'number_of_subcategories'=>Subcategory::where('category_id', '=', $this->id)->count(),
        'number_of_quizzes'=>Quiz::where('category_id', '=', $this->id)->count(),
        'popular_or_not'=>$this->popular_or_not,
        'created_at'=>$this->created_at->format('jS F Y')];
    }
}

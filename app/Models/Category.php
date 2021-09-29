<?php

namespace App\Models;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category_name', 'category_img', 'popular_or_not'];

    public function subcategories() {
    	return $this->hasMany(Subcategory::class);
    }
    
}

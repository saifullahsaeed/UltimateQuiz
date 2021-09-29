<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Daily;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'image_url'];

    public function category() {
    	return $this->belongsTo(Category::class);
    }

    public function quizzes() {
    	return $this->hasMany(Quiz::class);
    }

    public function dailies() {
    	return $this->hasMany(Daily::class);
    }
}

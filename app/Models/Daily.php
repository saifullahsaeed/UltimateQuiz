<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'subcategory_id', 'image_url', 'quiz_id'];

    public function subcategory() {
    	return $this->belongsTo(Subcategory::class);
    }

    public function questions() {
    	return $this->hasMany(Question::class);
    }
}

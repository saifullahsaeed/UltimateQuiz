<?php

namespace App\Models;

use App\Models\AudioQuestion;
use App\Models\ImageQuestion;
use App\Models\Subcategory;
use App\Models\TextQuestion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'subcategory_id', 'image_url'];

    public function subcategory() {
    	return $this->belongsTo(Subcategory::class);
    }

    public function imagequestions() {
    	return $this->hasMany(ImageQuestion::class);
    }

    public function textquestions() {
    	return $this->hasMany(TextQuestion::class);
    }

    public function audioquestions() {
    	return $this->hasMany(AudioQuestion::class);
    }
}

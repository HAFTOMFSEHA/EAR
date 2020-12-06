<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\Language;
use App\Models\Genres;
use App\Models\Category;

class RadioList extends Model
{
    protected $fillable = ['language_id', 'country_id', 'category_id', 'genres_id', 'language_id', 'name', 'title', 'image', 'streaming_link', 'count', 'description'];

    public function country() 
    {
        return $this->belongsTo(Country::class);
    }

    public function genres() 
    {
        return $this->belongsTo(Genres::class);
    }

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }

    public function language() 
    {
        return $this->belongsTo(Language::class);
    }
}

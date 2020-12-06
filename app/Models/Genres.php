<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RadioList;

class Genres extends Model
{
    //
    protected $fillable = ['slug', 'name'];

    public function radioList()
    {
        return $this->belongsToMany(RadioList::class, 'radio_lists', 'genres_id');
    }

}

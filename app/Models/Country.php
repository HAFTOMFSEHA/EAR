<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RadioList;

class Country extends Model
{
    //
    protected $fillable = ['slug', 'name', 'image'];

    public function radioList()
    {
        return $this->belongsToMany(RadioList::class, 'radio_lists');
    }
}

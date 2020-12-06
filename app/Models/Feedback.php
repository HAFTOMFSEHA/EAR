<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $fillable = ['feedback_type_id', 'email', 'title', 'description', 'images'];
}

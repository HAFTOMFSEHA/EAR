<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreamingIssueReport extends Model
{
    //
    protected $fillable = ['radio_list_id', 'message'];

    public function radio()
    {
        return $this->belongsTo(RadioList::class, 'radio_list_id');
    }
}

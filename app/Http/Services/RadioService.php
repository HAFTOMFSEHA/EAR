<?php

namespace App\Http\Services;
use App\Models\RadioList;
use App\Models\Category;
use App\Models\Country;

class RadioService
{
    public function create($data) 
    {
        return RadioList::create($data);
    }

    public function update($radio , $data) 
    {
        return $radio->update($data);
    }

    public function delete($radio) 
    {
        return RadioList::destroy($radio->id);
    }
    
}
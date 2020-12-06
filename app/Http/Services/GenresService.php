<?php

namespace App\Http\Services;
use App\Models\Genres;

class GenresService
{
    public function create($data) 
    {
        return Genres::create($data);
    }

    public function update($genres , $data) 
    {
        return $genres->update($data);
    }

    public function delete($genres) 
    {
        return Genres::destroy($genres->id);
    }
    
}
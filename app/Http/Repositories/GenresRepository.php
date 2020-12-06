<?php

namespace App\Http\Repositories;
use App\Models\Genres;
use App\Models\RadioList;

class GenresRepository
{

    public function getFormData(Genres $genres)
	{
        return [
           'genres'		=> $genres,
		];
	}

    public function findAll() 
    {
        return Genres::latest('id')->get();
    }

    public function count() 
    {
        return Genres::count();
    }

    public function pluck() 
    {
        return Genres::pluck('name', 'id');
    }
    
    public function find($id) 
    {
        return Genres::find($id);
    }


    public function findAllApi() 
    {
        $genres =  Genres::select()->get();

        if(!$genres->isEmpty()) {
            return $this->mapData($genres);
        }

        return false;
    }

    public function mapData($data) 
    {
        $result = [];

        $destinationPath = baseUrl() . config('dashboard.genres_image');

        foreach($data as $item) {
            $radioList = RadioList::where('genres_id', $item->id)->select()->get();
            if(!$radioList->isEmpty()) { 
                $result[] = [
                    "id" => $item->id,
                    "name"=> $item->name ? $item->name : "",
                    "image"=> $item->image ? $destinationPath ."". $item->image : "",
                ];
            }
        }
        
        return $result;
    }

}
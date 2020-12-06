<?php

namespace App\Http\Repositories;
use App\Http\Repositories\LanguageRepository;
use App\Http\Repositories\CountryRepository;
use App\Http\Repositories\GenresRepository;
use App\Models\RadioList;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genres;
use App\Models\Language;

class RadioRepository
{
    public function getFormData(RadioList $radio)
	{
        $languageRepository = new LanguageRepository();
        $genresRepository = new GenresRepository();
        $countryRepository = new CountryRepository();
        return [
           'radio'		=> $radio,
           'languageList'		=> $languageRepository->pluck(),
           'countryList'		=> $countryRepository->pluck(),
           'genresList'		=> $genresRepository->pluck(),
		];
	}

    public function findAll() 
    {
        return RadioList::latest('id')->get();
    }

    public function mostlyPlayed() 
    {
        return RadioList::where('count', '!=', 0)->orderBy('count', 'desc')->select()->get();
    }
    
    public function find($id) 
    {
        return RadioList::find($id);
    }

    public function count() 
    {
        return RadioList::count();
    }

    public function findAllApi() 
    {
        return RadioList::select()->get();
    }

    public function countryNameById($id) 
    {
        return Country::where('id', $id)->value('name');
    }

    public function categoryNameById($id) 
    {
        return Category::where('id', $id)->value('name');
    }

    public function groupByCategory() 
    {
        return RadioList::all()->groupBy('category_id');
    }

    public function groupByCountry() 
    {
        return RadioList::all()->groupBy('country_id');
    }

    public function radioListByTypeId($type, $id) 
    {
        if($type == "category") {
            $typeDetail = Category::find($id);
            $convertType = "category_id";
        }

        else if($type == "genres") {
            $typeDetail = Genres::find($id);
            $convertType = "genres_id";
        }

        else if($type == "language") {
            $typeDetail = Language::find($id);
            $convertType = "language_id";
        }

        else if($type == "country") {
            $typeDetail = Country::find($id);
            $convertType = "country_id";
        }

        $radioData = RadioList::where($convertType, $id)->select()->get();

        $result = [];
        if(!$radioData->isEmpty() && $typeDetail) {
            $data['title'] = $typeDetail->name;
            $data['data'] = $this->mapData($radioData);
            $result = $data;
        }
        
        return $result;
    }

    public function latest() 
    {
        $radioData = RadioList::latest('id')->take(20)->get();

        if(!$radioData->isEmpty()) {
            return $this->mapData($radioData);
        }

        return false;
    }

    public function mostPlayed() 
    {
        $radioData = RadioList::orderBy('count', 'desc')->take(20)->get();

        if(!$radioData->isEmpty()) {
            return $this->mapData($radioData);
        }

        return false;
    }

    public function mapData($data) 
    {
        $destinationPath = baseUrl() . config('dashboard.radio_image');

        return $data->map(function($item) use($destinationPath) {
            return [
                "id" => $item->id,
                "country"=> $item->country()->value('name') ? $item->country()->value('name') : "",
                "category"=> $item->category()->value('name') ? $item->category()->value('name') : "",
                "genres"=> $item->genres()->value('name') ? $item->genres()->value('name') : "",
                "language"=> $item->language()->value('name') ? $item->language()->value('name') : "",
                "name"=> $item->name ? $item->name : "",
                "image"=> $item->image ? $destinationPath ."". $item->image : "",
                "streaming_link"=> $item->streaming_link ? $item->streaming_link : "",
                "count"=> $item->count,
                "description"=> $item->description ? $item->description : "",
            ];
        });
    }
}
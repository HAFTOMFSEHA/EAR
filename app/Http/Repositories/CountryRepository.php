<?php

namespace App\Http\Repositories;
use App\Models\Country;
use App\Models\RadioList;

class CountryRepository
{
    public function getFormData(Country $country)
	{
        return [
           'country'		=> $country,
		];
	}

    public function findAll() 
    {
        return Country::latest('id')->get();
    }

    public function count() 
    {
        return Country::count();
    }    

    public function pluck() 
    {
        return Country::pluck('name', 'id');
    }

    public function find($id) 
    {
        return Country::find($id);
    }

    public function findAllApi() 
    {
        $country = Country::select()->get();

        if(!$country->isEmpty()) {
            return $this->mapData($country);
        }

        return false;
    }

    public function mapData($data) 
    {
        $result = [];
        
        foreach($data as $item) {
            $radioList = RadioList::where('country_id', $item->id)->select()->get();
            if(!$radioList->isEmpty()) { 
                $result[] = [
                    "id" => $item->id,
                    "name"=> $item->name ? $item->name : "",
                ];
            }
        }
        
        return $result;
    }

}
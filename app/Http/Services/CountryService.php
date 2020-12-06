<?php

namespace App\Http\Services;
use App\Models\Country;

class CountryService
{
    public function create($data) 
    {
        return Country::create($data);
    }

    public function update($country , $data) 
    {
        return $country->update($data);
    }

    public function delete($country) 
    {
        return Country::destroy($country->id);
    }
    
}
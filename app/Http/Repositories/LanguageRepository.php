<?php

namespace App\Http\Repositories;
use App\Models\Language;
use App\Models\RadioList;

class LanguageRepository
{
    public function getFormData(Language $language)
	{
        return [
           'language'		=> $language,
		];
	}

    public function findAllApi() 
    {
        $language = Language::select()->get();

        if(!$language->isEmpty()) {
            return $this->mapData($language);
        }

        return false;
    }

    public function find($id) 
    {
        return Language::find($id);
    }

    public function pluck() 
    {
        return Language::pluck('name', 'id');
    }

    public function findAll() 
    {
        return Language::latest('id')->get();
    }

    public function mapData($data) 
    {
        $result = [];
        
        foreach($data as $item) {
            $radioList = RadioList::where('language_id', $item->id)->select()->get();
            if(!$radioList->isEmpty()) { 
                $result[] = [
                    "id" => $item->id,
                    "name"=> $item->name ? $item->name : "",
                ];
            }
        }
        
        return $result;
    }

    public function count() 
    {
        return Language::count();
    }

}
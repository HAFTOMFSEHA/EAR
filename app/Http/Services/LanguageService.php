<?php

namespace App\Http\Services;
use App\Models\Language;

class LanguageService
{
    public function create($data) 
    {
        return Language::create($data);
    }

    public function update($language , $data) 
    {
        return $language->update($data);
    }

    public function delete($language) 
    {
        return Language::destroy($language->id);
    }
    
}
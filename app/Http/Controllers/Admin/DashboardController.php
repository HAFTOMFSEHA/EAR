<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\RadioRepository;
use App\Http\Repositories\GenresRepository;
use App\Http\Repositories\CountryRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\LanguageRepository;

class DashboardController extends Controller
{
    public function admin() 
    {
        return redirect()->route('admin.dashboard');
    }

    public function index() 
    {
        $radioRepository = new RadioRepository();
        $countryRepository = new CountryRepository();
        $genresRepository = new GenresRepository();
        $languageRepository = new LanguageRepository();

        $data = [
            'countLanguage' => $languageRepository->count(),
            'countCountry' => $countryRepository->count(),
            'countGenres' => $genresRepository->count(),
            'countRadio' => $radioRepository->count(),
            
        ];

        return view('admin.index', $data);
    }

    
}

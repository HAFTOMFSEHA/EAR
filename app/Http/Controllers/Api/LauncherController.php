<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Repositories\RadioRepository;
use App\Http\Repositories\GenresRepository;
use App\Http\Repositories\CountryRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\LanguageRepository;
class LauncherController extends Controller
{
    protected $radioRepository;

    protected $genresRepository;

    protected $countryRepository;

    protected $categoryRepository;

    protected $languageRepository;

    public function __construct(
        RadioRepository $radioRepository,
        GenresRepository $genresRepository,
        CountryRepository $countryRepository,
        CategoryRepository $categoryRepository,
        LanguageRepository $languageRepository
        ) 
    {
        $this->radioRepository = $radioRepository;

        $this->genresRepository = $genresRepository;

        $this->categoryRepository = $categoryRepository;

        $this->countryRepository = $countryRepository;

        $this->languageRepository = $languageRepository;
    }

    public function index()
    {
        $contents = [] ;
        
        $recentAdded = $this->radioRepository->latest();
            
        $mostPlayed = $this->radioRepository->mostPlayed();
        
        $countryList = $this->countryRepository->findAllApi();
        
        $genresList = $this->genresRepository->findAllApi();

        $categoryList = $this->categoryRepository->findAllApi();

        $languageList = $this->languageRepository->findAllApi();
        
        if($recentAdded) {
            $contents[] = [
                'title' => 'Recently Added',
                'type' => 'recently_added',
                'data' => $recentAdded
            ];
        }

        if($mostPlayed) {
            $contents[] = [
                'title' => 'Mostly Played',
                'type' => 'mostly_played',
                'data' => $mostPlayed
            ];
        }

        if($countryList) {
            $contents[] = [
                'title' => 'Country',
                'type' => 'country',
                'data' => $countryList
            ];
        }

        if($genresList) {
            $contents[] = [
                'title' => 'Genres',
                'type' => 'genres',
                'data' => $genresList
            ];
        }

        return response()->json($contents, 200);
    }

    public function newLanuncher()
    {
        $contents = [] ;
        
        $recentAdded = $this->radioRepository->latest();
            
        $mostPlayed = $this->radioRepository->mostPlayed();
        
        $countryList = $this->countryRepository->findAllApi();
        
        $genresList = $this->genresRepository->findAllApi();

        $categoryList = $this->categoryRepository->findAllApi();

        $languageList = $this->languageRepository->findAllApi();
        
        if($recentAdded) {
            $contents[] = [
                'title' => 'Recently Added',
                'type' => 'recently_added',
                'data' => $recentAdded
            ];
        }

        if($mostPlayed) {
            $contents[] = [
                'title' => 'Mostly Played',
                'type' => 'mostly_played',
                'data' => $mostPlayed
            ];
        }

        if($languageList) {
            $contents[] = [
                'title' => 'Language',
                'type' => 'language',
                'data' => $languageList
            ];
        }
       
        if($countryList) {
            $contents[] = [
                'title' => 'Country',
                'type' => 'country',
                'data' => $countryList
            ];
        }

        if($genresList) {
            $contents[] = [
                'title' => 'Genres',
                'type' => 'genres',
                'data' => $genresList
            ];
        }

        return response()->json($contents, 200);
    }

    public function categoryList() 
    {
        $countryList = $this->countryRepository->findAllApi();
        
        $genresList = $this->genresRepository->findAllApi();

        $languageList = $this->languageRepository->findAllApi();

        $contents = [];

        if($genresList) {
            $contents[] = [
                'title' => 'Genres',
                'type' => 'genres',
                'data' => $genresList
            ];
        }

        if($countryList) {
            $contents[] = [
                'title' => 'Country',
                'type' => 'country',
                'data' => $countryList
            ];
        }

        if($languageList) {
            $contents[] = [
                'title' => 'Language',
                'type' => 'language',
                'data' => $languageList
            ];
        }

        return $contents;

    }

        
}

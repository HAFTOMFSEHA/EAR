<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\RadioRepository;

class RadioController extends Controller
{
    //
    protected $radioRepository;

    public function __construct(RadioRepository $radioRepository) 
    {
        $this->radioRepository = $radioRepository;
    }

    public function radioListCountryWise() 
    {
        $radioList = $this->radioRepository->groupByCountry();

        $destinationPath = baseUrl() . config('dashboard.radio_image');

        $result = $radioList->map(function($cat) use($destinationPath) {

            $categoryList['country'] = $this->radioRepository->countryNameById($cat[0]->country_id);
            $categoryList['data'] = $cat->map(function($item) {
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

            return $categoryList;
        });
        return response()->json($result->values(), 200);
    }

    public function radioListCategoryWise() 
    {
        $radioList = $this->radioRepository->groupByCategory();
        $destinationPath = baseUrl() . config('dashboard.radio_image');
        $result = $radioList->map(function($cat) use($destinationPath) {
            $categoryList['category'] = $this->radioRepository->categoryNameById($cat[0]->category_id);
            $categoryList['data'] = $cat->map(function($item) {
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

            return $categoryList;
        });

        return response()->json($result->values(), 200);
    }

    public function radioList(Request $request) 
    {
        if(isset($request->type) && isset($request->id)) {
            return $this->radioListByTypeId($request->type, $request->id);
        }

        $radioList = $this->radioRepository->findAllApi();
        $destinationPath = baseUrl() . config('dashboard.radio_image');
        $result = [];
        $result['data'] = $radioList->map(function($item) use($destinationPath) {
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

        return response()->json($result, 200);
    }

    public function radioListByTypeId($type, $id) 
    {
        return response()->json($this->radioRepository->radioListByTypeId($type, $id), 200);
    }

    
}

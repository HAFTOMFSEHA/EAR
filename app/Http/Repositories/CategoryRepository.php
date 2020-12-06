<?php

namespace App\Http\Repositories;
use App\Models\Category;

class CategoryRepository
{
    public function findAllApi() 
    {
        $categories = Category::select()->get();

        if(!$categories->isEmpty()) {
            return $this->mapData($categories);
        }

        return false;
    }

    public function find($id) 
    {
        return Category::find($id);
    }

    public function mapData($data) 
    {
        return $data->map(function($item) {
            return [
                "id" => $item->id,
                "title"=> $item->name ? $item->name : "",
            ];
        });
    }

}
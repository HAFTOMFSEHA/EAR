<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\RadioRepository;
use App\Http\Services\RadioService;

class CountController extends Controller
{
    protected $radioRepository;

    protected $radioService;

    public function __construct(RadioRepository $radioRepository, RadioService $radioService) 
    {
        $this->radioRepository = $radioRepository;

        $this->radioService = $radioService;
    }

    public function store(Request $request) 
    {
        if($radio = $this->radioRepository->find($request->id)) {
            $oldCount = $radio->count;
            $newCount = $oldCount + 1;
            $this->radioService->update($radio, ['count'=>$newCount]);
            return response()->json(['message' => 'Successfully Saved.'], 404);
        }

        return response()->json(['message' => 'Radio Not Found.'], 404);
    }

    
}

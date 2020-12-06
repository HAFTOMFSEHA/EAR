<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Auth;
use App\Http\Repositories\Support\FeedbackRepository;
use App\Http\Repositories\Support\FeedbackTypeRepository;
use App\Http\Services\Support\FeedbackService;
use App\Http\Services\Support\FeedbackTypeService;

class FeedbackController extends Controller
{
    protected $feedbackRepository;

    protected $feedbackService;

    protected $feedbackTypeRepository;

    protected $feedbackTypeService;

    public function __construct(
        FeedbackRepository $feedbackRepository, 
        FeedbackService $feedbackService,
        FeedbackTypeRepository $feedbackTypeRepository, 
        FeedbackTypeService $feedbackTypeService
    )
    {
        $this->feedbackRepository = $feedbackRepository;

        $this->feedbackService = $feedbackService;

        $this->feedbackTypeRepository = $feedbackTypeRepository;

        $this->feedbackTypeService = $feedbackTypeService;
    }

    public function index()
    {
        $feedback = $this->feedbackRepository->findAll();

        return $feedback;
    }

    
    public function feedBackType()
    {
        $feedType = $this->feedbackTypeRepository->findAll();
        
        return response()->json($feedType, 200);
    }

    public function edit($id)
    { 
        if(!$feedback = $this->feedbackRepository->firstForApp($id)) {
            return response()->json(['message' => 'Feedback not found'], 200);
        }

        $data = $this->feedbackRepository->getFormData($feedback);

        return $data;
    }

    public function store(Request $request)
    {
        $storeData = $request->only('feedback_type_id', 'title', 'email', 'description');

        // if(!$feedbackType =$this->feedbackTypeRepository->find($request->feedback_type_id)) {
        //     return response()->json(['message' => 'Feedback Type is not found.'], 200);
        // }

        //$storeData['title'] = $feedbackType->title;

        $feedback = $this->feedbackService->create($storeData);

        if ($fileName = $this->isFilesExist($request, $feedback)) {
            $feedback->images = json_encode($fileName);
            $feedback->update();
        }

        return response()->json(['message' => 'Thank you for your valuable feedback.'], 200);
    }

    public function update(Request $request, $id)
    {
        $feedback = $this->feedbackRepository->find($id);

        $updateData = $request->only('feedback_type_id', 'email', 'title', 'description');

        // if(!$feedbackType = $this->feedbackTypeRepository->find($request->feedback_type_id)) {
        //     return response()->json(['message' => 'Feedback Type is not found.'], 200);
        // }

        // $updateData['title'] = $feedbackType->title;

        if ($fileName = $this->isFilesExist($request, $feedback)) {
            $updateData['images'] = json_encode($fileName);
        }

        $this->feedbackService->update($feedback, $updateData);

        return response()->json(['message' => 'Thank you for your valuable feedback.'], 200);
    }

    function isFilesExist($request, $model)
    {
        $requestFileName = 'images'; 
        $destinationPath = public_path() . config('dashboard.feedback');

        if ($files = $request->hasFile($requestFileName)) {

            $fileName = $model->id;
            $files=$request->file($requestFileName);
            $images = [];

            if ($file = $this->uploadImage($files, $fileName, $destinationPath)) {
                $images[] = $file->getFileName();
            }

            // foreach($files as $file){
            //     if ($file = uploadImage($file, $fileName, $destinationPath)) {
            //         $images[] = $file->getFileName();
            //     }
            // }
            return $images;
        }
        return false;
    }

    function uploadImage(\Illuminate\Http\UploadedFile $file, $fileName, $destinationPath)
    {
        $randomNumber = rand ( 10000 , 99999 );

        $filename = date('Y-m-d-h-i-s')."-". $randomNumber ."-". $fileName . '.' . $file->getClientOriginalExtension();

        return $file->move($destinationPath, $filename);
    }


}
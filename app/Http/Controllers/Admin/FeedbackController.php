<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Support\FeedbackRepository;
use App\Http\Services\Support\FeedbackService;
use Laracasts\Flash\Flash;
use App\Http\Traits\ResponseTrait;

class FeedbackController extends Controller
{
    use ResponseTrait;

    protected $feedbackRepository;

    protected $feedbackService;

    public function __construct(FeedbackRepository $feedbackRepository, FeedbackService $feedbackService)
    {
        $this->feedbackRepository = $feedbackRepository;

        $this->feedbackService = $feedbackService;
    }

    public function index()
    {   
        $feedback = $this->feedbackRepository->findAll();

        return view('admin.feedback.index', compact('feedback')); 
    }

    public function destroy($id)
    {
        $feedback = $this->feedbackRepository->find($id);

        if($this->feedbackService->delete($feedback)) {

            Flash::success($this->deleted());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->back();

    }

   
}

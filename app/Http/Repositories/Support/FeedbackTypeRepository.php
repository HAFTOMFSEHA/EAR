<?php

namespace App\Http\Repositories\Support;

use App\Models\FeedbackType;

class FeedbackTypeRepository
{
    public function getFormData(FeedbackType $feedbackType)
    {
        return [
            'feedbackType'    => $feedbackType,
        ];
    }

    public function findAll()
    {
        return FeedbackType::select('id', 'title')->get();
    }

    public function find($id)
    {
        return FeedbackType::find($id);
    }
}
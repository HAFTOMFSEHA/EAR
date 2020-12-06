<?php

namespace App\Http\Services\Support;

use App\Models\FeedbackType;

class FeedbackTypeService
{
    public function create($data)
    {
        return FeedbackType::create($data);
    }

    public function update($feedbackType, $data)
    {
        return $feedbackType->update($data);
    }

    public function delete($feedbackType)
    {
        return $feedbackType->delete();
    }
}
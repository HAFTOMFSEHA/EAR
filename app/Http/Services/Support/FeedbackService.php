<?php

namespace App\Http\Services\Support;

use App\Models\Feedback;

class FeedbackService
{
    public function create($data)
    {
        return Feedback::create($data);
    }

    public function update($feedback, $data)
    {
        return $feedback->update($data);
    }

    public function delete($feedback)
    {
        return $feedback->delete();
    }
}
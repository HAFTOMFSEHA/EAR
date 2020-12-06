<?php

namespace App\Http\Repositories\Support;

use App\Models\Feedback;

class FeedbackRepository
{
    public function getFormData(Feedback $feedback)
    {
        return [
            'feedback'    => $feedback,
        ];
    }

    public function findAll()
    {
        return Feedback::latest('id')->get();
    }

    public function find($id)
    {
        return Feedback::find($id);
    }

    public function firstForApp($id)
    {
        return Feedback::where('id', $id)->select('feedback_type_id', 'email', 'title', 'description', 'images')->first();
    }
}
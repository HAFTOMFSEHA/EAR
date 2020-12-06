<?php

namespace App\Http\Repositories;
use App\Models\Notification;

class NotificationRepository
{
    public function getFormData(Notification $notification)
	{
        return [
           'notification'	=> $notification,
           
		];
	}

    public function findAll() 
    {
        return Notification::latest('id')->get();
    }
    
    public function find($id) 
    {
        return Notification::find($id);
    }

    
}
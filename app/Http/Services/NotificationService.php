<?php

namespace App\Http\Services;
use App\Models\Notification;
use OneSignal;

class NotificationService
{
    public function create($data) 
    {
        return Notification::create($data);
    }

    public function update($notification , $data) 
    {
        return $notification->update($data);
    }

    public function delete($notification) 
    {
        return Notification::destroy($notification->id);
    }

    public function sendNotificationWithoutImage($request, $image = false)  
    {

        $params = [];
        $params['android_accent_color'] = 'FFCCAA72'; // argb color value
        $params['small_icon'] = 'bg'; 
        if($image) {
            $params['big_picture'] = baseUrl() . config('dashboard.notification_image'). $image; 
        }
        $params['headings'] = [
            'en' => $request->title,
        ]; 
        $params['contents'] = [
            'en' => $request->message,
        ]; 

        $message = $request->message;
        
        OneSignal::addParams($params)->sendNotificationToAll($message);
    }
    
}
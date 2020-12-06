<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\NotificationRepository;
use App\Models\Notification;
use App\Http\Services\NotificationService;
use Laracasts\Flash\Flash;
use App\Http\Traits\ResponseTrait;

class NotificationController extends Controller
{
    use ResponseTrait;

    protected $notificationRepository;

    protected $notificationService;

    public function __construct(NotificationRepository $notificationRepository, NotificationService $notificationService)
    {
        $this->notificationRepository = $notificationRepository;

        $this->notificationService = $notificationService;

    }

    public function index() 
    {
        $notification = $this->notificationRepository->findAll();
       
        return view('admin.notification.index', compact('notification')); 
    }

    public function create(Notification $notification)
    {
        $data = $this->notificationRepository->getFormData($notification);

        return view('admin.notification.form', $data);
    }

    public function store(Request $request)
    {
        if($notification = $this->notificationService->create($request->only('title', 'message'))) {
            
            $destinationPath = public_path() . config('dashboard.notification_image');
            $image = false;

            if ($fileName = isFileExist($request, $notification, 'image', $destinationPath)) {
                $notification->image = $fileName;
                $notification->update();
                
                $image = $fileName;
            }

            $this->notificationService->sendNotificationWithoutImage($request, $image);

            Flash::success($this->success());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->route('admin.notification.index');
    }

    public function destroy($id)
    {
        $notification = $this->notificationRepository->find($id);

        if($this->notificationService->delete($notification)) {

            Flash::success($this->deleted());
        }
        else {
            Flash::error($this->tryAgain());
        }

        return redirect()->back();

    }

}

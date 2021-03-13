<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationsModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class BackController extends Controller
{
    protected $data;
    private $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationsModel();

        $this->middleware(function ($request, $next){
            $user = session('user');
            if($user->role_id == 3) {
                $this->data["messagesNumber"] = $this->notificationModel->getNumberOfAgentMessages($user->user_id);
                return $next($request);
            }
            if($user->role_id == 1) {
                $this->data["messagesNumber"] = $this->notificationModel->getNumberOfAdminMessages();
                return $next($request);
            }
        });

    }

    protected  function deleteImage($src)
    {
        if(\File::exists($src)) {

            \File::delete($src);
        }
    }


    private function getMessageNumber($user_id)
    {
        return $this->data["messagesNumber"] = $this->notificationModel->getNumberOfAgentMessages($user_id);
    }

    public function logs(){
        $this->data['logs'] = \LogActivity::getLogs();
        return view("admin/pages/activityLog",$this->data);
    }

}

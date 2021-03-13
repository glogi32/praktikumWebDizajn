<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Menu;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FrontAdminController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data["messages"] = Message::orderBy("created_at","desc")->get();
        $this->data["newMessages"] = Message::where("seen",0)->get();
        $this->data["menu"] = Menu::orderBy("order")->get();
    }

    protected function deleteImage($path){
        if(File::exists($path)) {
            File::delete($path);
        }
    }

    public function log($subject,$url,$method,$ip,$user_agent = null,$user_id = null){
        try {
            $log = new Log();
            $log->subject = $subject;
            $log->url = $url;
            $log->method = $method;
            $log->ip = $ip;
            $log->user_agent = $user_agent;
            $log->user_id = $user_id;

            $log->save();
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }


}

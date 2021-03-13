<?php


namespace App\Helpers;

use App\Models\LogModel;
use Illuminate\Http\Request;

class LogActivity
{
    public static function addToLog(Request $request,$subject){
        $logModel = new LogModel();

        if(session()->has("user")){
            $user_id = session("user")->user_id;
        }else{
            $user_id = null;
        }

        $logModel->addToLog($subject,$request->url(),$request->method(),$request->ip(),$request->userAgent(),$user_id);
    }

    public static function getLogs(){
        $logModel = new LogModel();
        return $logModel->getLogs();
    }


}

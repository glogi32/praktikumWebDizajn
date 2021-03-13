<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Menu;
use App\Models\Message;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $data;

    public function __construct()
    {

        $this->data["menu"] = Menu::orderBy("order")->get();
    }


    public function aboutUs(){
        return view("pages.about-us",$this->data);
    }



    public function printRatingStars($avgVote){
        $html = "";
        if($avgVote){
            for($i = 1; $i <= 5; $i++){
                if($avgVote >= 1){
                    $html .= " <i class='fas fa-star' style='color:orange;'></i>";
                    $avgVote--;
                }else{
                    if($avgVote >= 0.5){
                        $html .= " <i class='fas fa-star-half-alt' style='color:orange;'></i>";
                        $avgVote -= 0.5;
                    }else{
                        $html .=" <i class='far fa-star' style='color:orange;'></i>";
                    }
                }
            }
        }else{
            $html .= "<i class='far fa-star' style='color:orange;'></i>
                        <i class='far fa-star' style='color:orange;'></i>
                        <i class='far fa-star' style='color:orange;'></i>
                        <i class='far fa-star' style='color:orange;'></i>
                        <i class='far fa-star' style='color:orange;'></i>";
        }

        return $html;

    }


    public static function log($subject,$request){
        try {

            if(session()->has("user")){
                $user_id = session("user")->id;
            }else{
                $user_id = null;
            }

            $log = new Log();
            $log->subject = $subject;
            $log->url = $request->url();
            $log->method = $request->method();
            $log->ip = $request->ip();
            $log->user_agent = $request->userAgent();
            $log->user_id = $user_id;

            $log->save();
        }catch (\Exception $e){
            \Log::error($e->getMessage());
        }
    }
}

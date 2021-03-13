<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends FrontAdminController
{
    public function index(){
        Message::where("seen",0)->update(["seen" => 1]);
        return view("admin.pages.messages",$this->data);
    }

    public function insertMessage(Request $request){
        try {
            $message = new Message();
            $message->name = $request->input("name");
            $message->email = $request->input("email");
            $message->text = $request->input("message");
            $message->save();
            return response("",204);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return response("",500);
        }
    }
}

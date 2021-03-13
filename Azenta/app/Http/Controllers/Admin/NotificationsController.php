<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessageRequest;
use Illuminate\Http\Request;
use App\Models\NotificationsModel;


class NotificationsController extends BackController
{
    private $notificationsModel;

    public function __construct()
    {
        $this->notificationsModel = new NotificationsModel();

    }

    public function notifications()
    {
        $user = session("user");

        if($user->role_id == 3) {
            $this->data["messages"] = $this->notificationsModel->getAllAgentMessages($user->user_id);
            $this->data["messagesNumber"] = $this->notificationsModel->getNumberOfAgentMessages($user->user_id);
            $this->notificationsModel->setSeenAllAgentMessages($user->user_id);
        }
        if($user->role_id == 1) {
            $this->data["messages"] = $this->notificationsModel->getAllAdminMessages();
            $this->data["messagesNumber"] = $this->notificationsModel->getNumberOfAdminMessages();
            $this->notificationsModel->setSeenAllAdminMessages();
        }

        return view("/admin/pages/notifications",$this->data);
    }

    public function insertAgentMessage(Request $request){

        $agent = $request->input("Agent");
        $user = $request->input("User");
        $message = $request->input("Message");
        $property = $request->input("Property");


        try{
            $insertMessage = $this->notificationsModel->insertAgentMessage($message,$agent,$user,$property);

            return response(["insertMessageSuccess" => "Message successfully sent to agent!"], 200);

        }catch (\Exception $e){
            dd($e);
            \Log::error($e->getMessage());
            return response(["insertMessageError" => "Server error on sending message, try again later."], 500);
        }
    }

    public function insertAdminMessage(ContactMessageRequest $request){

        $name = $request->input("Name");
        $email = $request->input("Email");
        $text = $request->input("Text");


        try{
            $insertMessage = $this->notificationsModel->insertAdminMessage($name,$email,$text);

            return response(["insertMessageSuccess" => "Message successfully sent to agent!"], 200);

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return response(["insertMessageError" => "Server error on sending message, try again later."], 500);
        }
    }

}

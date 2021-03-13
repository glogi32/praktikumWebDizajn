<?php


namespace App\Models;


class NotificationsModel
{
    private $tableAgentMessages = "agent_messages";
    private $tableProperties = "properties";
    private $tableUserImages = "images_user";
    private $tableUsers = "users";
    private $tableAgentMessage = "agent_messages";
    private $tableAdminMessage = "admin_messages";

    public function getAllAgentMessages($agentId){
        return \DB::table($this->tableAgentMessages. " AS am")
            ->join($this->tableUsers. " AS u","u.user_id","=","am.user_id")
            ->join($this->tableProperties. " AS p","p.property_id","=","am.property_id")
            ->join($this->tableUserImages. " AS ui","u.user_id","=","ui.user_id")
            ->select("*","am.datePost as dateNotifyPost")
            ->where("am.agent_id",$agentId)
            ->get();
    }

    public function getNumberOfAgentMessages($agentId){
       return \DB::table($this->tableAgentMessages)
            ->select(\DB::raw("count(*) as messageNumber"))
            ->where([
                ["agent_id","=",$agentId],
                ["seen","=", 0]
            ])
            ->first();
    }

    public function setSeenAllAgentMessages($agentId){
        return \DB::table($this->tableAgentMessages)
            ->where("agent_id",$agentId)
            ->update(["seen" => 1]);
    }

    public function insertAgentMessage($message,$agent,$user,$property){
        return \DB::table($this->tableAgentMessage)
            ->insert([
                "text" => $message,
                "datePost" => time(),
                "agent_id" => $agent,
                "property_id" => $property,
                "user_id" => $user
            ]);
    }

    public function insertAdminMessage($name,$email,$text){
        return \DB::table($this->tableAdminMessage)
            ->insert([
                "name" => $name,
                "datePost" => time(),
                "email" => $email,
                "text" => $text
            ]);
    }

    public function getNumberOfAdminMessages(){
        return \DB::table($this->tableAdminMessage)
            ->select(\DB::raw("count(*) as messageNumber"))
            ->where("seen",0)
            ->first();
    }

    public function setSeenAllAdminMessages(){
        return \DB::table($this->tableAdminMessage)
            ->update(["seen" => 1]);
    }

    public function getAllAdminMessages(){
        return \DB::table($this->tableAdminMessage)
            ->orderBy("datePost","desc")
            ->get();
    }

}

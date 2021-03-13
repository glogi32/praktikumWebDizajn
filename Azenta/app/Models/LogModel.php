<?php


namespace App\Models;


class LogModel
{
    private $tableActivityLog = "activity_log";

    public function addToLog($subject,$url,$method,$ip,$user_agent,$user_id){
        return \DB::table($this->tableActivityLog)
            ->insert([
                "subject" => $subject,
                "url" => $url,
                "method" => $method,
                "ip" => $ip,
                "user_agent" => $user_agent,
                "user_id" => $user_id,
                "time" => time()
            ]);
    }

    public function getLogs(){
        return \DB::table($this->tableActivityLog)
            ->orderBy("time","desc")
            ->get();
    }
}

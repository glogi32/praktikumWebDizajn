<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontController;
use App\Models\Log;
use Illuminate\Http\Request;

class LogsController extends FrontController
{
    public function index(){
        $this->data["logs"] = Log::orderBy("created_at","desc")->paginate(10);
        return view("admin.pages.log",$this->data);
    }
}


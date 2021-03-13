<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends FrontAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        foreach ($services as $s){
            $s->urlEdit = route("services.edit",$s->id);
        }
        $this->data["services"] = $services;
        return view("admin.pages.services",$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data["form"] = "add";
        return view("admin.pages.services",$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();

        $service->name = $request->input("name");
        $service->price = (float)$request->input("price");
        $service->icon_class_name = $request->input("iconClassName");
        $service->description = $request->input("description");

        try {
            $service->save();
            $this->log("Admin successfully added service with id ".$service->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertServiceSuccess","Successfully adding service!");
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on admin adding service",$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertServiceError" , "Server error on adding service, try again later.")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $this->data["service"] = $service;
        $this->data["form"] = "edit";
        return view("admin.pages.services",$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $service = Service::find($id);

        $service->name = $request->input("name");
        $service->price = (float)$request->input("price");
        $service->icon_class_name = $request->input("iconClassName");
        $service->description = $request->input("description");

        try {
            $service->save();
            $this->log("Admin successfully updated service with id ".$service->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("editServiceSuccess","Service successfully updated!");
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on admin updating service with id ".$service->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("editServiceError" , "Server error on editing service, try again later.")->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        try{
            $service = Service::find($id);
            if(!$service){
                return response("",404);
            }
            $service->delete();
            $this->log("Admin successfully deleted service with id ".$id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return response("",204);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on admin deleting service with id ".$id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return response("",500);
        }
    }
}

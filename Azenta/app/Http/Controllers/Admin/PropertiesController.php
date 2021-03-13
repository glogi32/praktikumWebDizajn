<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Models\PropertiesModel;
use Illuminate\Http\Request;

class PropertiesController extends BackController
{
    private $propertiesModel;

    public function __construct()
    {
        $this->propertiesModel = new PropertiesModel();
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session("user")->role_id == 3){
            $this->data['properties'] = $this->propertiesModel->getAllPropertiesByUser(session("user")->user_id);
        }else {
            $this->data['properties'] = $this->propertiesModel->getAllProperties();
        }

        return view("admin/pages/properties", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = "insert";
        $this->data['cities'] = $this->propertiesModel->getAllCities();
        $this->data['types'] = $this->propertiesModel->getAllTypes();
        return view("admin/pages/properties",$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $name = $request->input("Name");
        $price = $request->input("Price");
        $address = $request->input("Address");
        $status = $request->input("Status");
        $description = $request->input("Description");
        $datePost = time();
        $dateExpire = strtotime($request->input("DateExpire"));
        $surface = $request->input("Surface");
        $rooms = $request->input("Rooms");
        $bathrooms = $request->input("Bathrooms");
        $garages = $request->input("Garages");
        $featured = $request->input("Featured");
        $main = $request->input("Main");

        $typeId = $request->input("Type");
        $cityId = $request->input("City");
        $userId = $request->input("User");


        \DB::beginTransaction();
        try {
            $image = $request->file("Image");
            $image_name = $image->getClientOriginalName()."_".time();
            $directory = \public_path()."/img/properties";
            $image->move($directory,$image_name);

            $path = "img/properties/".$image_name;

            $insertPropertyId = $this->propertiesModel->insertProperty($name,$price,$address,$status,$description,$datePost,$dateExpire,$surface,$rooms,$bathrooms,$garages,$featured,$main,$userId,$cityId,$typeId);
            $insertImage = $this->propertiesModel->insertImage($path, $image_name,$insertPropertyId);

        }
        catch (QueryException $e){

            \Log::error($e->getMessage());
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed adding property!");
            return redirect()->back()->with("insertPropertyError" , "Server error, try again later.");
        }
        if($insertPropertyId && $insertImage){

            \DB::commit();
            \LogActivity::addToLog($request,"User successfully added property!");
            return redirect()->back()->with("insertPropertySuccess","Property added successfully!");
        }else{
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed adding property!");
            return redirect()->back()->with("insertPropertyError" , "Server error, try again later.");
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->data['p'] = $this->propertiesModel->getOne($id);
        $this->data['cities'] = $this->propertiesModel->getAllCities();
        $this->data['types'] = $this->propertiesModel->getAllTypes();
        $this->data['form'] = "edit";
        return view("admin/pages/properties",$this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input("Name");
        $price = $request->input("Price");
        $address = $request->input("Address");
        $status = $request->input("Status");
        $description = $request->input("Description");
        $dateExpire = strtotime($request->input("DateExpire"));
        $surface = $request->input("Surface");
        $rooms = $request->input("Rooms");
        $bathrooms = $request->input("Bathrooms");
        $garages = $request->input("Garages");
        $featured = $request->input("Featured");
        $main = $request->input("Main");
        $updatedAt = time();

        $userId = $request->input("User");
        $typeId = $request->input("Type");
        $cityId = $request->input("City");



        \DB::beginTransaction();
        try {
            $image = $request->file("Image");
            if($image) {
                $image_name = $image->getClientOriginalName() . "_" . time();
                $directory = \public_path() . "/img/properties";
                $image->move($directory, $image_name);

                $path = "img/properties/" . $image_name;

                $property = $this->propertiesModel->getOneImage($id);
                $this->deleteImage($property->src);

                $updateImage = $this->propertiesModel->updateImage($path, $image_name, $id);
            }

            $updatePropertyId = $this->propertiesModel->updateProperty($name,$price,$address,$status,$description,$dateExpire,$surface,$rooms,$bathrooms,$garages,$featured,$main,$userId,$cityId,$typeId,$id);


        }
        catch (QueryException $e){

            \Log::error($e->getMessage());
            \DB::rollBack();
            return redirect()->back()->with("updatePropertyError" , "Server error, try again later.");
        }
        if($updatePropertyId){


            \DB::commit();
            \LogActivity::addToLog($request,"User successfully updated property!");
            return redirect()->back()->with("updatePropertySuccess","Property edited successfully!");
        }else{
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed updating property!");
            return redirect()->back()->with("updatePropertyError" , "Server error, try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request ,$id)
    {

        try{
            $delete = $this->propertiesModel->deleteProperties($id);
            if(!$delete){
                \LogActivity::addToLog($request,"User failed deleting property!");
                return response(["deleteError", "Error on deleting property, property not found!"],404);
            }
            \LogActivity::addToLog($request,"User successfully deleted property!");
            return response(["deleteSuccess","Properties successfully deleted"],200);
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
            \LogActivity::addToLog($request,"User failed deleting property!");
            return response(["deleteError", "Error on deleting properties, try again later!"],500);
        }
    }
}

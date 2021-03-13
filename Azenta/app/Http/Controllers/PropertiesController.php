<?php

namespace App\Http\Controllers;

use App\Models\PropertiesModel;
use Illuminate\Http\Request;

class PropertiesController extends FrontController
{
    protected $data;
    private $propertiesModel;

    public function __construct()
    {
        $this->propertiesModel = new PropertiesModel();
    }

    public function index()
    {

        $properties = $this->propertiesModel->getAllPropertiesPaginate();

        foreach ($properties as $key=>$p) {
            $description = explode(".", $p->description);
            $properties[$key]->descriptionShort = $description[0] . ".";
        }

        $this->data['properties'] = $properties;
        $this->data['cities'] = $this->propertiesModel->getAllCities();
        $this->data["currentDate"] = time();
        $this->data['bestAgents'] = $this->propertiesModel->getBestAgents();
        $this->activeLink();
        return view("pages/properties",$this->data);
    }

    public function filterProperties(Request $request){
        if($request->ajax()) {
            $searchText = $request->input("searchText");
            $status = $request->input("status");
            $location = $request->input("location");
            $rooms = explode("-", $request->input("rooms"));
            $bathrooms = explode("-", $request->input("bathrooms"));
            $garages = explode("-", $request->input("garages"));

            $smallSize = $request->input("smallSize");
            $bigSize = $request->input("bigSize");
            $smallPrice = $request->input("smallPrice");
            $bigPrice = $request->input("bigPrice");

            if($rooms[0] != "null"){
                $smallRoom = $rooms[0];
                $bigRoom = $rooms[1];
            }else{
                $smallRoom[0] = null;
                $bigRoom = null;
            }

            if($bathrooms[0] != "null"){
                $smallBathroom = $bathrooms[0];
                $bigBathroom = $bathrooms[1];
            }else{
                $smallBathroom = null;
                $bigBathroom = null;
            }

            if($garages[0] != "null"){
                $smallGarage = $garages[0];
                $bigGarage = $garages[1];
            }else{
                $smallGarage = null;
                $bigGarage = null;
            }


            try{
            $properties = $this->propertiesModel->filterProperties($searchText,$status,$location,$smallRoom,$bigRoom,$smallBathroom,$bigBathroom,$smallGarage,$bigGarage,$smallSize,$bigSize,$smallPrice,$bigPrice);
            foreach ($properties as $key=>$p) {
                $description = explode(".", $p->description);
                $properties[$key]->descriptionShort = $description[0] . ".";
            }

            $this->data['properties'] = $properties;
            $this->data["currentDate"] = time();

            $this->activeLink();
            return view("partials.properties",$this->data);
            }
            catch (\Exception $e){
                \Log::error($e->getMessage());
                return response("",500);
            }
        }


    }

    public function showOne($id){
        try{
            $this->data['property'] = $this->propertiesModel->getOne($id);
            $this->data['bestAgents'] = $this->propertiesModel->getBestAgents();
            $this->activeLink();
            return view("pages/property-single",$this->data);
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->back();
        }

    }





}

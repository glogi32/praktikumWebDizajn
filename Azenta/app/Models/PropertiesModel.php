<?php


namespace App\Models;


class PropertiesModel
{
    private $tableProperties = "properties";
    private $tableTypes = "property_type";
    private $tableCity = "cities";
    private $tablePropertyImages = "images_property";
    private $tableUsers = "users";
    private $tableUserImages = "images_user";


    public function getAllCities(){
        return \DB::table($this->tableCity)
            ->get();
    }

    public function getAllTypes(){
        return \DB::table($this->tableTypes)
            ->get();
    }

    public function insertImage($path, $image_name,$propertyId){
        return \DB::table($this->tablePropertyImages)
            ->insertGetId([
                "src" => $path,
                "alt" => $image_name,
                "property_id" => $propertyId
            ]);
    }

    public function insertProperty($name,$price,$address,$status,$description,$datePost,$dateExpire,$surface,$rooms,$bathrooms,$garages,$featured,$main,$userId,$cityId,$typeId){
        return \DB::table($this->tableProperties)
            ->insertGetId([
                "name" => $name,
                "price" => $price,
                "address" => $address,
                "status" => $status,
                "description" => $description,
                "datePost" => $datePost,
                "dateExpired" => $dateExpire,
                "surfaceArea" => $surface,
                "numRooms" => $rooms,
                "numBathrooms" => $bathrooms,
                "numGarage" => $garages,
                "featured" => $featured,
                "main" => $main,
                "user_id" => $userId,
                "city_id" => $cityId,
                "type_id" => $typeId
            ]);
    }

    public function getAllProperties(){
        return \DB::table($this->tableProperties. " AS p")
            ->join($this->tableTypes. " AS t","t.type_id","=","p.type_id")
            ->join($this->tableCity. " AS c","c.city_id","=","p.city_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->join($this->tablePropertyImages. " AS pi","pi.property_id","=","p.property_id")
            ->join($this->tableUserImages. " AS ui","ui.user_id","=","p.user_id")
            ->select("*","p.name AS propertyName", "c.name AS cityName","t.name AS typeName","ui.src AS srcUser","ui.alt AS altUser","pi.src AS srcProperty","pi.alt AS altProperty","p.updated_at AS updatedProperty")
            ->where("p.isDeleted",0)
            ->get();
    }

    public function getBestAgents(){
        return \DB::table($this->tableUsers. " AS u")
            ->join($this->tableProperties. " AS p","u.user_id","=","p.user_id")
            ->join($this->tableUserImages. " AS ui","ui.user_id","=","p.user_id")
            ->selectRaw("DISTINCT u.user_id, u.firstName, u.lastName,(select count(*) from properties pu where pu.user_id = u.user_id) as propertiesNumber,  ui.src AS srcUser, ui.alt AS altUser")
            ->where("p.isDeleted",0)
            ->orderBy("propertiesNumber","desc")
            ->limit(3)
            ->get();
    }



    public function getAllPropertiesByUser($id){
        return \DB::table($this->tableProperties. " AS p")
            ->join($this->tableTypes. " AS t","t.type_id","=","p.type_id")
            ->join($this->tableCity. " AS c","c.city_id","=","p.city_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->join($this->tablePropertyImages. " AS pi","pi.property_id","=","p.property_id")
            ->join($this->tableUserImages. " AS ui","ui.user_id","=","p.user_id")
            ->select("*","p.name AS propertyName", "c.name AS cityName","t.name AS typeName","ui.src AS srcUser","ui.alt AS altUser","pi.src AS srcProperty","pi.alt AS altProperty","p.updated_at AS updatedProperty")
            ->where([
                ["p.user_id","=",$id],
                ["p.isDeleted","=",0]
            ])
            ->get();
    }

    public function getOne($id){
        return \DB::table($this->tableProperties. " AS p")
            ->join($this->tableTypes. " AS t","t.type_id","=","p.type_id")
            ->join($this->tableCity. " AS c","c.city_id","=","p.city_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->join($this->tablePropertyImages. " AS pi","pi.property_id","=","p.property_id")
            ->join($this->tableUserImages. " AS ui","ui.user_id","=","p.user_id")
            ->select("*","p.name AS propertyName", "c.name AS cityName","t.name AS typeName","ui.src AS srcUser","ui.alt AS altUser","pi.src AS srcProperty","pi.alt AS altProperty")
            ->where([
                ["p.property_id","=",$id],
                ["p.isDeleted","=",0]
            ])
            ->first();
    }


    public function updateProperty($name,$price,$address,$status,$description,$dateExpire,$surface,$rooms,$bathrooms,$garages,$featured,$main,$userId,$cityId,$typeId,$id){
        return \DB::table($this->tableProperties)
            ->where("property_id","=",$id)
            ->update([
                "name" => $name,
                "price" => $price,
                "address" => $address,
                "status" => $status,
                "description" => $description,
                "dateExpired" => $dateExpire,
                "surfaceArea" => $surface,
                "numRooms" => $rooms,
                "numBathrooms" => $bathrooms,
                "numGarage" => $garages,
                "featured" => $featured,
                "main" => $main,
                "user_id" => $userId,
                "city_id" => $cityId,
                "type_id" => $typeId,
                "updated_at" => time()
            ]);
    }

    public function updateImage($path, $image_name,$id){
        return \DB::table($this->tablePropertyImages)
            ->where("property_id",$id)
            ->update([
                "src" => $path,
                "alt" => $image_name,
            ]);
    }

    public function getOneImage($id){
        return \DB::table($this->tablePropertyImages)
            ->where("property_id",$id)
            ->first();
    }

    public function deleteProperties($id){
        return \DB::table($this->tableProperties)
            ->where("property_id",$id)
            ->update([
                "isDeleted" => 1
            ]);
    }

    public function getTop3(){
        return \DB::table($this->tableProperties. " AS p")
            ->join($this->tableTypes. " AS t","t.type_id","=","p.type_id")
            ->join($this->tableCity. " AS c","c.city_id","=","p.city_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->join($this->tablePropertyImages. " AS pi","pi.property_id","=","p.property_id")
            ->select("*","p.name AS propertyName", "c.name AS cityName","t.name AS typeName")
            ->orderBy("price","desc")
            ->limit(3)
            ->get();
    }

    public function getAllPropertiesPaginate(){
        return \DB::table($this->tableProperties. " AS p")
            ->join($this->tableTypes. " AS t","t.type_id","=","p.type_id")
            ->join($this->tableCity. " AS c","c.city_id","=","p.city_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->join($this->tablePropertyImages. " AS pi","pi.property_id","=","p.property_id")
            ->join($this->tableUserImages. " AS ui","ui.user_id","=","p.user_id")
            ->select("*","p.name AS propertyName", "c.name AS cityName","t.name AS typeName","ui.src AS srcUser","ui.alt AS altUser","pi.src AS srcProperty","pi.alt AS altProperty")
            ->paginate(4);
    }

    public function filterProperties($searchText,$status,$location,$smallRoom,$bigRoom,$smallBathroom,$bigBathroom,$smallGarage,$bigGarage,$smallSize,$bigSize,$smallPrice,$bigPrice){
        $query =  \DB::table($this->tableProperties. " AS p")
            ->join($this->tableTypes. " AS t","t.type_id","=","p.type_id")
            ->join($this->tableCity. " AS c","c.city_id","=","p.city_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->join($this->tablePropertyImages. " AS pi","pi.property_id","=","p.property_id")
            ->join($this->tableUserImages. " AS ui","ui.user_id","=","p.user_id")
            ->select("*","p.name AS propertyName", "c.name AS cityName","t.name AS typeName","ui.src AS srcUser","ui.alt AS altUser","pi.src AS srcProperty","pi.alt AS altProperty");
            if($searchText){
                $query->where("p.name","like","%".$searchText."%")
                ->orWhere("p.address","like","%".$searchText."%");
            }
            if($status){
                $query->where("p.status","=",$status);
            }
            if($location){
                $query->where("p.city_id","=",$location);
            }
            if($bigRoom){
                $query->whereBetween("p.numRooms",[$smallRoom,$bigRoom]);
            }
            if($bigBathroom){
                $query->WhereBetween("p.numBathrooms",[$smallBathroom,$bigBathroom]);
            }
            if($bigGarage){
                $query->WhereBetween("p.numGarage",[$smallGarage,$bigGarage]);
            }
            if($bigSize){
                $query->WhereBetween("p.surfaceArea",[$smallSize,$bigSize]);
            }
            if($bigPrice){
                $query->WhereBetween("p.price",[$smallPrice,$bigPrice]);
            }

        return $query->paginate(4);
    }



}

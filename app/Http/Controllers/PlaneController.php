<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Plane;

class PlaneController extends Controller
{
    public function create()
    {
        $data["title"] = "Agregar avión";
        return view('planes.create')->with("data",$data); // CAMBIAR ESTO
    }
    
    public function list()
    {
        $data["planes"] = Plane::all();
        return view('planes.list')->with("data",$data);
    }

    public function save(Request $request)
    {   
        $selected = $request->input("value");
        Plane::validate($request);
        Plane::create($request->only(["name","status","value"]));
        if($selected==1){
            return view('layouts.fresa');
        }else if($selected==2){
            return view('layouts.video');
        }else if($selected==3){
            return view('layouts.ciudad');
        }else if($selected==4){
            return view('layouts.cafe');
        }
        
    }

    public function stats()
    {
        $data["planes"] = Plane::all();
        $data["active"]=0;
        $data["unactive"]=0;
        foreach ($data["planes"] as $planes) {
            if ($planes->getStatus()=="Activo")
            {
                $data["active"] = $data["active"] + $planes->getValue();
            }
            else
            {
                $data["unactive"] = $data["active"] + $planes->getValue();
            }
        }

        //$data["active"]->$active;
        //$data["unactive"]->$unactive;
        return view('planes.stats')->with("data",$data);


    }

}
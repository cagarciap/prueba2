<?php

namespace App\Http\Controllers;
use App\Models\Plane;

class HomeController extends Controller
{
    public function index()
    {
    	$data["planes"] = Plane::all();
    	if (count($data["planes"]) != 0){
    		$data["check"] = "true";
    	}else{
    		$data["check"] = "false";
    	}
        return view('home.index')->with("data",$data);
    }

}
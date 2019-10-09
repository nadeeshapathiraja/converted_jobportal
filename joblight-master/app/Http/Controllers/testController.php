<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class testController extends Controller
{
    //
    public function testFunction(){
        $crimeTypeList=db::table('crime_categories')->get();
        return view('admin.crimeTypeList',compact('crimeTypeList'));
    }
}


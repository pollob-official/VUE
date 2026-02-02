<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    function index(){
        return view ("student.index");
    }
    function create(){
        return view ("student.create");
    }
    function save(Request $request){
        // $name=$request->name;
        // $id=$request->id;
        // return "student $id, $name create successfully";
         return "student create successfully";
    }
    function find($id){
        return "student find $id";
    }

}


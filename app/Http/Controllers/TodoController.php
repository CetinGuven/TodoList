<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    public function add(Request $request)
    {      
        $validator = Validator::make($request->all(), [
            "title" => "required",
            "description" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }
        $todo = Todo::create([
           "user_id" =>$request->id,
            "title" => $request->title,
            "description" => $request->description,
        ]);
        return response()->json(["status" => "success"], 200);
    }   
    public function update(Request $request ){

        $validator = Validator::make($request->all(), [
            "title" => "required",
            "description" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }
        $todo = Todo::where('id',$request->id)->update([
            "title" => $request->title,
            "description" => $request->description,
        ]);
        return response()->json(["status" => "success"], 200);
    }
    public function show(Request $request){

        $todo = Todo::where('user_id',$request->id)->get();
        return response()->json(["status" => "success","data"=>$todo], 200);
    }
    
    public function completed(Request $request){
        $todo = Todo::where('id',$request->id)->update([
            "status" => 1,
        ]);
        return response()->json(["status" => "success"], 200);
    }
    
    public function delete( Request $request){
        $todo = Todo::where('id',$request->id)->delete();
        return response()->json(["status" => "success"], 200);
    }
    }
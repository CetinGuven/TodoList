<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        return response()->json(["status" => "success"], 200);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 422);
        }
        $credentials = $request->only("email", "password");

        if (Auth::attempt($credentials)) {
            $id = Auth::user();
            Session::put('username', $id->id);
            return response()->json(["status" => "success",$id], 200);
        } else {
            return response()->json(["error" => "Invalid credentials"], 401);
        }
    }
    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        return response()->json(["status" => "success"], 200);
    }
}

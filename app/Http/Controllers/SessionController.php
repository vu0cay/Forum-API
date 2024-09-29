<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class SessionController extends Controller
{
    public function login(Request $request): JsonResponse {
        
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'password' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json(["success" => false, "message" => "Please fill all fields."], 200);
        }

        $user = User::where('student_id', $request['student_id'])->first();
        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response()->json(["success" => false, "message" => "Login failed"], 200);
        }
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json(["success" => true, "message" => "Login successfully", "data" => $user, "token" => $token], 200);
    }
    public function logout(): JsonResponse {
        Auth::user()->tokens()->delete();
        return response()->json(["success" => true, "message" => "Logout successfully"], 200);
    }
    public function user(Request $request): JsonResponse {
        $user = $request->user();
        if(!$user) 
            return $user;

        return response()->json(["success" => true, "data" => $user], 200);
    }

}

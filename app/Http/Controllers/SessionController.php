<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class SessionController extends Controller
{
    public function __invoke(Request $request): JsonResponse {
        
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
        else 
            return response()->json(["success" => true, "message" => "Login successfully", "data" => $user], 200);
    }

}

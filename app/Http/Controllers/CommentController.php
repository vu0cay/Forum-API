<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'content' => 'required',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        if($validator->fails()) {
            return response()->json(["success" => false, "message" => "Something went wrong."], 200);
        }
        
        $comment = Auth::user()->comments()->create([
            "post_id" => $request->input("post_id"),
            "content" => $request->input("content"),
            "parent_id" => $request->input("parent_id") 
        ]);
      
        $comment = Auth::user()->comments()->latest()->with('user')->first();
        
        return response()->json(["success" => true, "message" => "Comment created successfully", "data" => $comment], 200);


    }
}

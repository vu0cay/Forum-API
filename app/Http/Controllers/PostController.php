<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index() : JsonResponse {
        
        $posts = Post::latest()->with(['user', 'tags', 'comments'])->get();

        return response()->json(PostResource::collection($posts),200);
    }
    public function show($id) : JsonResponse {
        $posts = Post::find($id);
        return response()->json(PostResource::collection([$posts]),200);
    }
    public function store(Request $request) : JsonResponse {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'user_id' => 'required',
            'vote' => 'integer|nullable'
        ]);

        if($validator->fails()) {
            return response()->json(["success" => false, "message" => "Please fill all fields."], 200);
        }

        $post = Post::create([
            "content" => $request["content"],
            'user_id' => $request["user_id"],
            "vote" => $request["vote"] ?? 0
        ]);

        $post = Post::latest()->with('user', 'tags', 'comments')->first();

        return response()->json(PostResource::collection([$post]),200);
    }
    public function update(Request $request , $id) : JsonResponse {
        $validator = Validator::make($request->all(), [
            'content' => 'string|nullable',
            'vote' => 'integer'
        ]);

        if($validator->fails()) {
            return response()->json(["success" => false, "message" => "Please fill all fields."], 200);
        }
        $post = Post::find($id);
        if(!$post) 
            return response()->json(["success" => false, "message" => "Not found"], 404);
        
        
        $post->update([
            "content" => $request["content"] ?? $post["content"],
            "vote" => $request["vote"]
        ]);

        return response()->json(PostResource::collection([$post]),200);
    }
    public function delete($id) : JsonResponse {

        $post = Post::find($id);
        if(!$post) 
            return response()->json(["success" => false, "message" => "Not found"], 404);
            
        $post->delete();

        return response()->json(["success" => true, "message" => "deleted successfully"],200);
    }

    public function tags($id) : JsonResponse {
        
        $post = Post::find($id);
        if(!$post) 
            return response()->json(["success" => false, "message" => "Post not found"],404);
        $tags = $post->tags;
        return response()->json(TagResource::collection($tags),200);
    }

    public function comments($id) : JsonResponse {
        
        $post = Post::find($id);
        if(!$post) 
            return response()->json(["success" => false, "message" => "Post not found"],404);
        $comments = $post->comments;
        return response()->json(CommentResource::collection($comments),200);

    }
}

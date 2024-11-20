<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\TagResource;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Vote;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index() : JsonResponse {
        
        $posts = Post::latest()->with(['user', 'tags', 'comments.user', 'votes'])->get();

        return response()->json(PostResource::collection($posts),200);
    }
    public function show($id) : JsonResponse {
        $posts = Post::find($id)->with(['user', 'tags', 'comments', 'votes'])->get();

        return response()->json(PostResource::collection($posts),200);
    }
    public function store(Request $request) : JsonResponse {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'tags' => 'string|nullable'
        ]);

        if($validator->fails()) {
            return response()->json(["success" => false, "message" => "Please fill all fields."], 200);
        }
        
        $post = Post::create([
            "content" => $request->input("content"),
            "thumbnail" => $request->input("thumbnail"),
            "student_id" => Auth::user()->student_id
        ]);
        $str = $request->input("tags");
        if($str) {
            
            $tags = explode(",", $str);
            foreach($tags as $tag) {
                $tag = Tag::firstOrCreate(["name" => $tag]);
                $post->tags()->attach($tag);
            }
        }

        $post = Post::latest()->with(['user', 'tags', 'comments', 'votes'])->first();
        
        return response()->json(["success" => true, "data" => PostResource::collection([$post])],200);
    }
    public function update(Request $request , $id) : JsonResponse {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'tags' => 'string|nullable'
        ]);

        if($validator->fails()) {
            return response()->json(["success" => false, "message" => "Please fill all fields."], 200);
        }

        $post = Auth::user()->posts()->find($id);

        if(!$post) 
            return response()->json(["success" => false, "message" => "Cannot update"], 404);
        
        
        $post->update([
            "content" => $request["content"] ?? $post["content"],
            "thumbnail" => $request["thumbnail"] ?? $post["thumbnail"],
        ]);
        $str = $request->input("tags");
        $post->tags()->detach();
        if($str) {
            $tags = explode(",", $str);
            foreach($tags as $tag) {
                $tag = Tag::firstOrCreate(["name" => $tag]);
                $post->tags()->attach($tag);
                
            }
        }

        $post = Post::latest()->with(['user', 'tags', 'comments', 'votes'])->first();
        return response()->json(["success" => true, "data" => PostResource::collection([$post])],200);
    }

    public function delete($id) : JsonResponse {
        $post = Auth::user()->posts()->find($id);

        if(!$post) 
            return response()->json(["success" => false, "message" => "Cannot delete"], 404);
            
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
        foreach($comments as $comment) {
            $comment->load(['user']);    
        }
        return response()->json($comments,200);

    }
    public function up_vote($id, Request $request) : JsonResponse {
        
        try {
            $vote = Vote::create([
                "post_id" => $id,
                "student_id" => Auth::user()->student_id
            ]);
        } catch(Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 404);
        }

        return response()->json(["success" => true, "message" => "Vote successfully"], 200);

    }
    public function down_vote($id) : JsonResponse {
        
        try {
            $vote = Vote::query()
                        ->where("student_id", Auth::user()->student_id)
                        ->where("post_id", $id)
                        ->first();
            // dd($vote);
            $vote->delete();
        } catch(Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 404);
        }

        return response()->json(["success" => true, "message" => "Un vote successfully", "data"=>$vote], 200);

    }
}

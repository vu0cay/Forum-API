<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke() {
        

        if(request('user')) { 
            $users = User::query()
                    ->where('name', 'LIKE', '%'.request('user').'%')
                    ->get();
        
            return response()->json(UserResource::collection($users),200);
        } else {

            $posts = Post::query()
                    ->with(['user', 'tags', 'comments', 'votes'])
                    ->where('content', 'LIKE', '%'.request('post').'%')
                    ->get();
    
            return response()->json(PostResource::collection($posts),200);
        }

    }
}

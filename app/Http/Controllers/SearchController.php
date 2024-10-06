<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke() {
        
        $posts = Post::query()
                ->with(['user', 'tags', 'comments', 'votes'])
                ->where('content', 'LIKE', '%'.request('q').'%')
                ->get();

        return response()->json(PostResource::collection($posts),200);
    }
}

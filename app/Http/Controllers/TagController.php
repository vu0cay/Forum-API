<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke(Tag $tag) {
        $posts = $tag->posts()->with('user', 'tags', 'comments')->get();
        return response()->json(PostResource::collection($posts),200);
    }
}

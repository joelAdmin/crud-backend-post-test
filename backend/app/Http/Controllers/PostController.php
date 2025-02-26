<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Js;

class PostController extends Controller
{
    public function index():AnonymousResourceCollection
    {
        return PostResource::collection(Post::with('user', 'comments')->get());
    }

    public function store(StorePostRequest $request) {
        $post = Post::create($request->validated());
        return new PostResource($post);
    }
    
    public function update(UpdatePostRequest $request, Post $post) {
        $post->update($request->validated());
        return new PostResource($post);
    }
}

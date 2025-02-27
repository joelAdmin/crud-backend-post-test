<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
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
        try {
            $post = Post::create($request->validated());
            return new PostResource($post);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
       
    }
    
    public function update(UpdatePostRequest $request, Post $post) {
        $post->update($request->validated());
        return new PostResource($post);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $posts = Post::paginate(5);
        return PostResource::collection($posts);
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    public function store(PostRequest $request): PostResource
    {
        if (Gate::allows('is_editor') || Gate::allows('is_admin')) {
            // Tylko editor lub admin ma dostęp do tworzenia posta
            $data = $request->all();
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = 'posts/' . uniqid() .'.' . $file->Extension();
                $file->storePubliclyAs('public', $name);
                $data['file'] = $name;
            }
            $post = Post::create($data);
            return new PostResource($post);
        }
        return abort(403, 'Bad permission');
    }

    public function update(PostRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        if (Gate::allows('is_editor') || Gate::allows('is_admin')) {
            // Tylko editor lub admin ma dostęp do edycji posta
            $post->update($request->all());

            return response()->json(['message' => 'Post updated']);
        }
        return abort(403, 'Bad permission');
    }
}

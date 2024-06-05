<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Post::all(),
            'message' => 'Posts retrieved successfully',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validator = validator($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $post = Post::create($request->all());

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post,

        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'data' => $post,
            'message' => 'Post retrieved successfully',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $validator = validator($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $post->update($request->all());

        return response()->json([
            'message' => 'Post updated successfully',
            'data' => $post,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
        ]);
    }
}

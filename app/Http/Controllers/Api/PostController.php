<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('category')->latest();

        if (!$request->get || $request->get !== 'all') {
            $posts = $posts->take(12);
        }

        if ($request->category) {
            $posts->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            })->take(9);
        }

        // Execute the query and get the results
        $posts = $posts->get();

        return response([
            "message" => "Get all posts success",
            "posts" => $posts
        ]);
    }

    public function show($slug)
    {
        $post = Post::with('category')->firstWhere('slug', $slug);
        if (!$post) {
            return response([
                'message' => "Not found"
            ], 404);
        }

        return response([
            "message" => "Get post success",
            "post" => $post,
        ]);
    }
}

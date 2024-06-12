<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $posts = Post::latest();
        if ($request->search) {
            $posts->where('title', 'LIKE', "%$request->search%")->orWhere('description', 'LIKE', "%$request->search%")->orWhere(function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    return $query->where('name', "LIKE", "%$request->search%");
                });
            });
        }
        return view('posts.index', [
            "posts" => $posts->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('posts.create', [
            "categories" => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "title" => "required|min:3",
            "slug" => "required|min:3|unique:posts,slug",
            "category_id" => "required|exists:categories,id",
            "description" => "required|min:3",
            "image" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('image')->store('posts');
        $validated_data['image'] = $imagePath;

        $post = Post::create($validated_data);
        if (!$post) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/posts')->with('success', "Successfully create a post");
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            "categories" => Category::all()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|min:3",
            "slug" => "required|min:3",
            "category_id" => "required|exists:categories,id",
            "description" => "required|min:3",
            "image" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:posts,slug', function (Fluent $input) use ($post) {
            return $input->slug !== $post->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('image')) {
            // delete previous file
            $filePath = public_path("images/$post->image");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('image')->store('posts');
            $validated_data['image'] = $imagePath;
        }

        $result = $post->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/posts')->with('success', "Successfully update post");
    }

    public function destroy(Post $post)
    {
        $success = Post::destroy($post->id);

        $filePath = public_path("images/$post->image");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/posts')->with('success', "Successfully delete a post");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->title) {
            $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::latest();
        if ($request->search) {
            $categories->where('name', 'LIKE', "%$request->search%");
        }
        return view('categories.index', [
            "categories" => $categories->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "slug" => "required|min:3|unique:categories,slug",
        ]);

        $category = Category::create($validated_data);
        if (!$category) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/categories')->with('success', "Successfully create a category");
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3",
        ]);

        $validator->sometimes('slug', 'unique:categories,slug', function (Fluent $input) use ($category) {
            return $input->slug !== $category->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        $result = $category->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/categories')->with('success', "Successfully update category");
    }

    public function destroy(Category $category)
    {
        $success = Category::destroy($category->id);

        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/categories')->with('success', "Successfully delete a category");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->name) {
            $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

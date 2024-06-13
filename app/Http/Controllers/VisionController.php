<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class VisionController extends Controller
{
    public function index(Request $request)
    {

        $visions = Vision::latest();
        if ($request->search) {
            $visions->where('title', 'LIKE', "%$request->search%")->orWhere('description', 'LIKE', "%$request->search%");
        }
        return view('visions.index', [
            "visions" => $visions->paginate(10)->withQueryString(),
            "total_items" => $visions->count()
        ]);
    }

    public function create()
    {
        return view('visions.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "title" => "required|min:3",
            "slug" => "required|min:3|unique:visions,slug",
            "description" => "required|min:3",
            "image" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('image')->store('visions');
        $validated_data['image'] = $imagePath;

        $vision = Vision::create($validated_data);
        if (!$vision) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/visions')->with('success', "Successfully create a vision");
    }

    public function edit(Vision $vision)
    {
        return view('visions.edit', [
            'vision' => $vision
        ]);
    }

    public function show(Vision $vision)
    {
        return view('visions.show', [
            'vision' => $vision
        ]);
    }

    public function update(Request $request, Vision $vision)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|min:3",
            "slug" => "required|min:3",
            "description" => "required|min:3",
            "image" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:visions,slug', function (Fluent $input) use ($vision) {
            return $input->slug !== $vision->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('image')) {
            // delete previous file
            $filePath = public_path("images/$vision->image");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('image')->store('visions');
            $validated_data['image'] = $imagePath;
        }

        $result = $vision->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/visions')->with('success', "Successfully update vision");
    }

    public function destroy(Vision $vision)
    {
        $success = Vision::destroy($vision->id);

        $filePath = public_path("images/$vision->image");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/visions')->with('success', "Successfully delete a vision");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->title) {
            $slug = SlugService::createSlug(Vision::class, 'slug', $request->title);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

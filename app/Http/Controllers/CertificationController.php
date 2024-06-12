<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CertificationController extends Controller
{
    public function index(Request $request)
    {

        $certifications = Certification::latest();
        if ($request->search) {
            $certifications->where('title', 'LIKE', "%$request->search%")->orWhere('description', 'LIKE', "%$request->search%");
        }
        return view('certifications.index', [
            "certifications" => $certifications->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('certifications.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "title" => "required|min:3",
            "slug" => "required|min:3|unique:certifications,slug",
            "description" => "required|min:3",
            "image" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('image')->store('certifications');
        $validated_data['image'] = $imagePath;

        $certification = Certification::create($validated_data);
        if (!$certification) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/certifications')->with('success', "Successfully create a certification");
    }

    public function edit(Certification $certification)
    {
        return view('certifications.edit', [
            'certification' => $certification
        ]);
    }

    public function show(Certification $certification)
    {
        return view('certifications.show', [
            'certification' => $certification
        ]);
    }

    public function update(Request $request, Certification $certification)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|min:3",
            "slug" => "required|min:3",
            "description" => "required|min:3",
            "image" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:certifications,slug', function (Fluent $input) use ($certification) {
            return $input->slug !== $certification->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('image')) {
            // delete previous file
            $filePath = public_path("images/$certification->image");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('image')->store('certifications');
            $validated_data['image'] = $imagePath;
        }

        $result = $certification->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/certifications')->with('success', "Successfully update certification");
    }

    public function destroy(Certification $certification)
    {
        $success = Certification::destroy($certification->id);

        $filePath = public_path("images/$certification->image");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/certifications')->with('success', "Successfully delete a certification");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->title) {
            $slug = SlugService::createSlug(Certification::class, 'slug', $request->title);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

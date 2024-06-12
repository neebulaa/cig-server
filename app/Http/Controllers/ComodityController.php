<?php

namespace App\Http\Controllers;

use App\Models\Comodity;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class ComodityController extends Controller
{
    public function index(Request $request)
    {

        $comodities = Comodity::latest();
        if ($request->search) {
            $comodities->where('name', 'LIKE', "%$request->search%");
        }
        return view('comodities.index', [
            "comodities" => $comodities->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('comodities.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "slug" => "required|min:3|unique:comodities,slug",
            "icon" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('icon')->store('comodities');
        $validated_data['icon'] = $imagePath;

        $comodity = Comodity::create($validated_data);
        if (!$comodity) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/comodities')->with('success', "Successfully create a comodity");
    }

    public function edit(Comodity $comodity)
    {
        return view('comodities.edit', [
            'comodity' => $comodity
        ]);
    }

    public function update(Request $request, Comodity $comodity)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3",
            "icon" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:comodities,slug', function (Fluent $input) use ($comodity) {
            return $input->slug !== $comodity->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('icon')) {
            // delete previous file
            $filePath = public_path("images/$comodity->icon");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('icon')->store('comodities');
            $validated_data['icon'] = $imagePath;
        }

        $result = $comodity->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/comodities')->with('success', "Successfully update comodity");
    }

    public function destroy(Comodity $comodity)
    {
        $success = Comodity::destroy($comodity->id);

        $filePath = public_path("images/$comodity->icon");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/comodities')->with('success', "Successfully delete a comodity");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->name) {
            $slug = SlugService::createSlug(Comodity::class, 'slug', $request->name);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

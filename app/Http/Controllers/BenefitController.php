<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class BenefitController extends Controller
{
    public function index(Request $request)
    {

        $benefits = Benefit::latest();
        if ($request->search) {
            $benefits->where('title', 'LIKE', "%$request->search%")->orWhere('description', 'LIKE', "%$request->search%");
        }
        return view('benefits.index', [
            "benefits" => $benefits->paginate(10)->withQueryString(),
            "total_items" => $benefits->count()
        ]);
    }

    public function create()
    {
        return view('benefits.create');
    }

    public function store(Request $request)
    {
        $benefits_count = Benefit::all()->count();
        if ($benefits_count == 3) {
            return back()->with('error', 'Maximum benefits exceeded!');
        }

        $validated_data = $request->validate([
            "title" => "required|min:3",
            "slug" => "required|min:3|unique:benefits,slug",
            "description" => "required|min:3",
            "icon" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('icon')->store('benefits');
        $validated_data['icon'] = $imagePath;

        $benefit = Benefit::create($validated_data);
        if (!$benefit) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/benefits')->with('success', "Successfully create a benefit");
    }

    public function edit(Benefit $benefit)
    {
        return view('benefits.edit', [
            'benefit' => $benefit
        ]);
    }

    public function show(Benefit $benefit)
    {
        return view('benefits.show', [
            'benefit' => $benefit
        ]);
    }

    public function update(Request $request, Benefit $benefit)
    {
        $validator = Validator::make($request->all(), [
            "title" => "required|min:3",
            "slug" => "required|min:3",
            "description" => "required|min:3",
            "icon" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:benefits,slug', function (Fluent $input) use ($benefit) {
            return $input->slug !== $benefit->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('icon')) {
            // delete previous file
            $filePath = public_path("images/$benefit->icon");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('icon')->store('benefits');
            $validated_data['icon'] = $imagePath;
        }

        $result = $benefit->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/benefits')->with('success', "Successfully update benefit");
    }

    // public function destroy(Benefit $benefit)
    // {
    //     $success = Benefit::destroy($benefit->id);

    //     $filePath = public_path("images/$benefit->icon");
    //     if (File::exists($filePath)) {
    //         File::delete($filePath);
    //     }
    //     if (!$success) {
    //         return back()->with('error', 'Something went wrong!');
    //     }
    //     return redirect('/benefits')->with('success', "Successfully delete a benefit");
    // }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->title) {
            $slug = SlugService::createSlug(Benefit::class, 'slug', $request->title);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

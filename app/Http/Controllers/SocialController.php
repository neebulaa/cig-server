<?php

namespace App\Http\Controllers;

use App\Models\Social;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class SocialController extends Controller
{
    public function index(Request $request)
    {

        $socials = Social::latest();
        if ($request->search) {
            $socials->where('type', 'LIKE', "%$request->search%")
                ->orWhere(function ($query) use ($request) {
                    $query->whereHas('company', function ($query) use ($request) {
                        return $query->where('name', "LIKE", "%$request->search%");
                    });
                });
        }
        return view('socials.index', [
            "socials" => $socials->paginate(10)->withQueryString(),
            "total_items" => $socials->count()
        ]);
    }

    public function create()
    {
        return view('socials.create', [
            "companies" => Company::all(),
            "social_medias" => array_keys(Social::$social_medias)
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "company_id" => "required|exists:companies,id",
            "link" => "required|url",
            "type" => ['required', Rule::in(array_keys(Social::$social_medias))]
        ], [
            "company_id" => "A company is required"
        ]);

        $social = Social::create($validated_data);
        if (!$social) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/socials')->with('success', "Successfully create a social");
    }

    public function edit(Social $social)
    {
        return view('socials.edit', [
            'social' => $social,
            "companies" => Company::all(),
            "social_medias" => array_keys(Social::$social_medias)
        ]);
    }

    public function update(Request $request, Social $social)
    {
        $validator = Validator::make($request->all(), [
            "company_id" => "required|exists:companies,id",
            "link" => "required|url",
            "type" => ['required', Rule::in(array_keys(Social::$social_medias))]
        ], [
            "company_id" => "A company is required"
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        $result = $social->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/socials')->with('success', "Successfully update social");
    }

    public function destroy(Social $social)
    {
        $success = Social::destroy($social->id);
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/socials')->with('success', "Successfully delete a social");
    }
}

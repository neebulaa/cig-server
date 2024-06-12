<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Comodity;
use App\Models\Pinpoint;
use Illuminate\Http\Request;
use App\Models\RegionComodity;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class RegionController extends Controller
{
    public function index(Request $request)
    {

        $regions = Region::latest();
        if ($request->search) {
            $regions->where('title', 'LIKE', "%$request->search%")->orWhere('type', 'LIKE', "%$request->search%")->orWhere('description', 'LIKE', "%$request->search%");
        }
        return view('regions.index', [
            "regions" => $regions->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('regions.create', [
            "comodities" => Comodity::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3|unique:regions,slug",
            "type" => "required|in:province,harbor",
            "description" => "required|min:3",
            "comodities" => "",
            "pos-x" => "required",
            "pos-y" => "required"
        ], [
            "pos-x" => "Please pinpoint the location",
            "pos-y" => "Please pinpoint the location",
        ]);

        $validator->sometimes('comodities', 'required|array|min:1', function (Fluent $input) {
            return $input->type === 'province';
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        $region = Region::create($validated_data);
        if (!$region) {
            return back()->with('error', 'Something went wrong!');
        }

        // create region comodities
        if ($validated_data['type'] === 'province') {
            foreach ($validated_data['comodities'] as $comoditySlug) {
                $comodity = Comodity::firstWhere('slug', $comoditySlug);
                RegionComodity::create([
                    "region_id" => $region->id,
                    "comodity_id" => $comodity->id
                ]);
            }
        }

        // create region pinpoint
        Pinpoint::create([
            'region_id' => $region->id,
            "pos_x" => $validated_data['pos-x'],
            "pos_y" => $validated_data['pos-y'],
        ]);

        return redirect('/regions')->with('success', "Successfully create a region");
    }

    public function edit(Region $region)
    {
        $comodities = Comodity::latest()->get();
        return view('regions.edit', [
            'region' => $region,
            "comodities" => $comodities
        ]);
    }

    public function show(Region $region)
    {
        return view('regions.show', [
            'region' => $region
        ]);
    }

    public function update(Request $request, Region $region)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3",
            "type" => "required|in:province,harbor",
            "description" => "required|min:3",
            "comodities" => "",
            "pos-x" => "required",
            "pos-y" => "required"
        ], [
            "pos-x" => "Please pinpoint the location",
            "pos-y" => "Please pinpoint the location",
        ]);

        $validator->sometimes('comodities', 'required|array|min:1', function (Fluent $input) {
            return $input->type === 'province';
        });

        $validator->sometimes('slug', 'unique:regions,slug', function (Fluent $input) use ($region) {
            return $input->slug !== $region->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        // delete all product comodity
        $product_comodities = RegionComodity::where('region_id', $region->id)->get();
        $product_comodities->each(function ($product_comodity) {
            $product_comodity->delete();
        });

        // adding new product comodity
        if ($validated_data['type'] === 'province') {
            foreach ($validated_data['comodities'] as $comoditySlug) {
                $comodity = Comodity::firstWhere('slug', $comoditySlug);
                RegionComodity::create([
                    "region_id" => $region->id,
                    "comodity_id" => $comodity->id
                ]);
            }
        }

        // update pinpoint
        $pinpoint = $region->pinpoint;
        $pinpoint->update([
            "pos_x" => $validated_data['pos-x'],
            "pos_y" => $validated_data['pos-y'],
        ]);

        $result = $region->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/regions')->with('success', "Successfully update region");
    }

    public function destroy(Region $region)
    {
        $success = Region::destroy($region->id);

        $filePath = public_path("images/$region->image");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/regions')->with('success', "Successfully delete a region");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->name) {
            $slug = SlugService::createSlug(Region::class, 'slug', $request->name);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

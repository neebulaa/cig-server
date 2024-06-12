<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function index(Request $request)
    {

        $companies = Company::latest();
        if ($request->search) {
            $companies->where('name', 'LIKE', "%$request->search%")
                ->orWhere('about', 'LIKE', "%$request->search%")
                ->orWhere('phone', 'LIKE', "%$request->search%")
                ->orWhere('address', 'LIKE', "%$request->search%");
        }
        return view('companies.index', [
            "companies" => $companies->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "slug" => "required|min:3|unique:companies,slug",
            "about" => "required|min:3",
            "phone" => "required|min:3",
            "address" => "required|min:3",
            "logo" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('logo')->store('companies');
        $validated_data['logo'] = $imagePath;

        $company = Company::create($validated_data);
        if (!$company) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/companies')->with('success', "Successfully create a company");
    }

    public function edit(Company $company)
    {
        return view('companies.edit', [
            'company' => $company
        ]);
    }

    public function show(Company $company)
    {
        return view('companies.show', [
            "company" => $company
        ]);
    }

    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3",
            "about" => "required|min:3",
            "phone" => "required|min:3",
            "address" => "required|min:3",
            "logo" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:companies,slug', function (Fluent $input) use ($company) {
            return $input->slug !== $company->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('logo')) {
            // delete previous file
            $filePath = public_path("images/$company->logo");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('logo')->store('companies');
            $validated_data['logo'] = $imagePath;
        }

        $result = $company->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/companies')->with('success', "Successfully update company");
    }

    public function destroy(Company $company)
    {
        $success = Company::destroy($company->id);

        $filePath = public_path("images/$company->logo");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/companies')->with('success', "Successfully delete a company");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->name) {
            $slug = SlugService::createSlug(Company::class, 'slug', $request->name);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

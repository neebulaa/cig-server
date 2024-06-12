<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comodity;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use App\Models\ProductComodity;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('comodities')->latest();
        if ($request->search) {
            $products->where('name', 'LIKE', "%$request->search%")
                ->orWhere('description', 'LIKE', "%$request->search%")
                ->orWhere(function ($query) use ($request) {
                    $query->whereHas('comodities', function ($q) use ($request) {
                        return $q->where('name', 'LIKE', "%$request->search%");
                    });
                });
        }
        return view('products.index', [
            "products" => $products->paginate(10)->withQueryString(),
        ]);
    }

    public function create()
    {
        $comodities = Comodity::latest()->get();
        return view('products.create', [
            "comodities" => $comodities
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "slug" => "required|min:3|unique:products,slug",
            "comodities" => "required|array|min:1",
            "description" => "required|min:3",
            "image" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('image')->store('products');
        $validated_data['image'] = $imagePath;

        $product = Product::create($validated_data);
        if (!$product) {
            return back()->with('error', 'Something went wrong!');
        }

        foreach ($validated_data['comodities'] as $comoditySlug) {
            $comodity = Comodity::firstWhere('slug', $comoditySlug);
            ProductComodity::create([
                "product_id" => $product->id,
                "comodity_id" => $comodity->id
            ]);
        }
        return redirect('/products')->with('success', "Successfully create a product");
    }

    public function edit(Product $product)
    {
        $comodities = Comodity::latest()->get();
        return view('products.edit', [
            "product" => $product,
            "comodities" => $comodities
        ]);
    }

    public function show(Product $product)
    {
        return view('products.show', [
            "product" => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3",
            "comodities" => "required|array|min:1",
            "description" => "required|min:3",
            "image" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:products,slug', function (Fluent $input) use ($product) {
            return $input->slug !== $product->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('image')) {
            // delete previous file
            $filePath = public_path("images/$product->image");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('image')->store('products');
            $validated_data['image'] = $imagePath;
        }

        $result = $product->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }

        // delete all product comodity
        $product_comodities = ProductComodity::where('product_id', $product->id)->get();
        $product_comodities->each(function ($product_comodity) {
            $product_comodity->delete();
        });

        // adding new product comodity
        foreach ($validated_data['comodities'] as $comoditySlug) {
            $comodity = Comodity::firstWhere('slug', $comoditySlug);
            ProductComodity::create([
                "product_id" => $product->id,
                "comodity_id" => $comodity->id
            ]);
        }

        return redirect('/products')->with('success', "Successfully update product");
    }

    public function destroy(Product $product)
    {
        $success = Product::destroy($product->id);
        $filePath = public_path("images/$product->image");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/products')->with('success', "Successfully delete a product");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->name) {
            $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

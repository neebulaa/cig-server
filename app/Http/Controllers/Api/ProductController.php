<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->slice(0, 10);
        return response([
            "message" => "Get all products success",
            "products" => $products
        ]);
    }

    public function catalog(Request $request)
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
        return response([
            "products" => $products->paginate(2)->withQueryString(),
        ]);
    }
}

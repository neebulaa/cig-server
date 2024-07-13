<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->slice(0, 12);
        return response([
            "message" => "Get all products success",
            "products" => $products
        ]);
    }

    public function catalog()
    {
        $products = Product::with('comodities',  'comodities.regions')->latest()->get();
        return response([
            "message" => "Get all products success",
            "products" => $products,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pinpoint;
use Illuminate\Http\Request;

class PinpointController extends Controller
{
    public function index(Request $request)
    {
        $pinpoints = Pinpoint::with('region')->latest();
        if ($request->search) {
            $pinpoints->whereHas('region', function ($query) use ($request) {
                $query->where('name', 'LIKE', "%$request->search%")->orWhere('type', 'LIKE', "%$request->search%")->orWhere('description', 'LIKE', "%$request->search%");
            });
        }
        return view("pinpoints.index", [
            "pinpoints" => Pinpoint::with('region')->latest()->get(),
            "filtered_pinpoints" => $pinpoints->get()
        ]);
    }
}

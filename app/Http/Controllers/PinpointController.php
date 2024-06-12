<?php

namespace App\Http\Controllers;

use App\Models\Pinpoint;
use Illuminate\Http\Request;

class PinpointController extends Controller
{
    public function index()
    {
        $pinpoints = Pinpoint::with('region')->get();
        return view("pinpoints.index", [
            "pinpoints" => $pinpoints
        ]);
    }
}

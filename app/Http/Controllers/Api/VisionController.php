<?php

namespace App\Http\Controllers\Api;

use App\Models\Vision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisionController extends Controller
{
    public function index(){
        $visions = Vision::all();
        return response([
            "message" => "Get all visions success",
            "visions" => $visions
        ]);
    }
}

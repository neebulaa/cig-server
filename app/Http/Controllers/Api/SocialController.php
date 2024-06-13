<?php

namespace App\Http\Controllers\Api;

use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::all();
        return response([
            "message" => "Get all socials success",
            "socials" => $socials
        ]);
    }
}

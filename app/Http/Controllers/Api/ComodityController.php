<?php

namespace App\Http\Controllers\Api;

use App\Models\Comodity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComodityController extends Controller
{
    public function index()
    {
        $comodities = Comodity::all();
        return response([
            "message" => "Get all comodities success",
            "comodities" => $comodities
        ]);
    }
}

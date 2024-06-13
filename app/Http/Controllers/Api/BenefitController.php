<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index(){
        $benefits = Benefit::all();
        return response([
            "message" => "Get all benefits success",
            "benefits" => $benefits
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::all();
        return response([
            "message" => "Get all certifications success",
            "certifications" => $certifications
        ]);
    }
}

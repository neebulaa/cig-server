<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function my_company()
    {
        $company = Company::firstWhere('slug', 'pt-crescentia-indo-global-cig');
        return response([
            "message" => "Get all company success",
            "company" => $company
        ]);
    }
}

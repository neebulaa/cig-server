<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\PageContentValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageContentController extends Controller
{
    public function main()
    {
        $mainPageContent = PageContent::with('values')->where("page", 'main')->get();
        $mainPageContentFormatted = $mainPageContent->reduce(function ($acc, $curr) {
            [$section] = explode('-', $curr->key);
            $acc[$section][] = $curr;
            return $acc;
        }, []);
        return view('page-content.main', [
            "pageContents" => $mainPageContentFormatted
        ]);
    }

    public function articles()
    {
        return view('page-content.articles');
    }

    public function products()
    {
        return view('page-content.products');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\TableFilter;
use Illuminate\Http\Request;
use App\Models\PageContentValue;
use Illuminate\Support\Facades\Validator;

class PageContentController extends Controller
{
    public function index($page)
    {
        $availablePages = PageContent::pluck('page')->unique()->values();
        if (!$availablePages->contains($page)) $page = 'main';
        $pageContent = PageContent::with('values')->where("page", $page)->get();
        $pageContentFormatted = $pageContent->reduce(function ($acc, $curr) {
            [$section] = explode('-', $curr->key);
            if ($curr->values->firstWhere('type', 'table_filters')) {
                $curr->filters = TableFilter::all();
            }
            $acc[$section][] = $curr;
            return $acc;
        }, []);
        return view("page-content", [
            "title" => ucfirst($page),
            "pageContents" => $pageContentFormatted
        ]);
    }
}

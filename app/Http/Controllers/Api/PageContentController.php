<?php

namespace App\Http\Controllers\Api;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PageContentController extends Controller
{
    public function index()
    {
        $page_contents = PageContent::all();

        $formatted_page_contents = $page_contents->reduce(function ($result, $page_content) {
            // page
            if (!isset($result[$page_content->page])) {
                $result[$page_content->page] = [];
            }

            // section
            [$section_name, $section_part] = explode('-', $page_content->key);
            if (!isset($result[$page_content->page][$section_name])) {
                $result[$page_content->page][$section_name] = [];
            }

            $page_content_values = [];
            foreach ($page_content->values as $value) {
                if (isset($page_content_values[$value->type])) {
                    if (is_array($page_content_values[$value->type])) {
                        $page_content_values[$value->type][] = $value->value;
                    } else {
                        $page_content_values[$value->type] = [$value->value];
                    }
                } else {
                    if ($value->type == 'table_filters') {
                        $table_filters = explode(',', $value->value);
                        foreach ($table_filters as $table) {
                            $page_content_values[$value->type][$table] = DB::table($table)->select()->get();
                        }
                    } else {
                        $page_content_values[$value->type] = $value->value;
                    }
                }
            }

            if (count(array_keys($page_content_values)) == 1) {
                $page_content_values = array_values($page_content_values)[0];
            }

            $result[$page_content->page][$section_name][$section_part] = $page_content_values;
            return $result;
        }, []);

        return response([
            "message" => "Get page content success!",
            "page_contents" => $formatted_page_contents
        ]);
    }

    public function main_update(Request $request, PageContent $page_content)
    {

        $rules = [];
        foreach ($page_content->values as $index => $page_content_value) {
            $rules["{$page_content_value->type}_" . $index + 1] = [
                'required',
                $page_content_value->type == 'table_filters' ? 'array' : 'string',
                $page_content_value->type == 'table_filters' ? 'min:1' : "min:3"
            ];
        }
        $validator = Validator::make($request->all(), $rules, [
            "required" => "Please enter all the required fields!",
            "min" => "The fields must be at least :min characters!"
        ]);

        if ($validator->fails()) {
            return response([
                "message" => "Invalid fields",
                "errors" => $validator->errors()
            ], 422);
        }

        $validated_data = $validator->validated();
        foreach ($page_content->values as $index => $page_content_value) {
            $value = $validated_data["{$page_content_value->type}_" . $index + 1];
            $value = is_array($value) ? implode(',', $value) : $value;
            $page_content_value->update([
                "value" => $value
            ]);
        }

        return response([
            "message" => "Successfully update data"
        ]);
    }
}

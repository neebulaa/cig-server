<?php

namespace App\Http\Controllers\Api;

use App\Models\PageContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PageContentController extends Controller
{
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

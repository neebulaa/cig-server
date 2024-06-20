<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pinpoint;
use Illuminate\Support\Facades\Validator;

class PinpointController extends Controller
{
    public function index()
    {
        $pinpoints = Pinpoint::where('is_active', true)->with('region', 'region.comodities')->latest()->get();
        return response([
            "message" => "Get all pinpoints success",
            "pinpoints" => $pinpoints
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "slugs" => "required|array|exists:regions,slug"
        ]);

        if ($validator->fails()) {
            return response([
                "message" => "Error fields",
                "errors" => $validator->errors()
            ], 422);
        }

        $validated_data = $validator->validated();

        // set all active to false
        Pinpoint::query()->update([
            "is_active" => false
        ]);

        // set selected region to true
        foreach ($validated_data['slugs'] as $slug) {
            $pinpoint = Pinpoint::whereHas("region", function ($query) use ($slug) {
                return $query->where('slug', $slug);
            });
            $pinpoint->update([
                "is_active" => true
            ]);
        }

        return response([
            "message" => "Successfully update pin points"
        ]);
    }
}

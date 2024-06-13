<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $team_members = TeamMember::all();
        return response([
            "message" => "Get all team members success",
            "team_members" => $team_members
        ]);
    }
}

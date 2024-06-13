<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {

        $team_members = TeamMember::latest();
        if ($request->search) {
            $team_members->where('name', 'LIKE', "%$request->search%")
                ->orWhere('occupation', 'LIKE', "%$request->search%")
                ->orWhere('bio', 'LIKE', "%$request->search%");
        }
        return view('team_members.index', [
            "team_members" => $team_members->paginate(10)->withQueryString(),
            "total_items" => $team_members->count()
        ]);
    }

    public function create()
    {
        return view('team_members.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "slug" => "required|min:3|unique:team_members,slug",
            "bio" => "required|min:3",
            "occupation" => "required|min:3",
            "profile_image" => "image|file:1024"
        ]);

        $imagePath = null;
        if ($request->file('profile_image')) {
            $imagePath = $request->file('profile_image')->store('team_members');
        }
        $validated_data['profile_image'] = $imagePath;

        $team_member = TeamMember::create($validated_data);
        if (!$team_member) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/team-members')->with('success', "Successfully create a team member");
    }

    public function edit(TeamMember $team_member)
    {
        return view('team_members.edit', [
            'team_member' => $team_member
        ]);
    }

    public function show(TeamMember $team_member)
    {
        return view('team_members.show', [
            'team_member' => $team_member
        ]);
    }

    public function update(Request $request, TeamMember $team_member)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3",
            "bio" => "required|min:3",
            "occupation" => "required|min:3",
            "profile_image" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:team_members,slug', function (Fluent $input) use ($team_member) {
            return $input->slug !== $team_member->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('profile_image')) {
            // delete previous file
            $filePath = public_path("images/$team_member->profile_image");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('profile_image')->store('team_members');
            $validated_data['profile_image'] = $imagePath;
        }

        $result = $team_member->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/team-members')->with('success', "Successfully update team member");
    }

    public function destroy(TeamMember $team_member)
    {
        $success = TeamMember::destroy($team_member->id);

        $filePath = public_path("images/$team_member->profile_image");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/team-members')->with('success', "Successfully delete a team member");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->name) {
            $slug = SlugService::createSlug(TeamMember::class, 'slug', $request->name);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

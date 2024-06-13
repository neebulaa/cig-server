<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{
    public function index(Request $request)
    {

        $editors = User::latest()->where('role', '!=', 'owner');
        $owner = User::firstWhere('role', 'owner');
        if ($request->search) {
            $editors->where('name', 'LIKE', "%$request->search%")->orWhere('username', 'LIKE', "%$request->search%")->orWhere("role", "LIKE", "%$request->search%");
        }
        return view('editors.index', [
            "editors" => $editors->paginate(10)->withQueryString(),
            "owner" => $owner
        ]);
    }

    public function create()
    {
        return view('editors.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "username" => "required|min:3|unique:users,username",
            "password" => "required|min:3|regex:/^[a-z0-9_.]+$/i",
            "password_confirmation" => "required|same:password"
        ], [
            "password.regex" => "Password can only contains alphanumeric, _, or ."
        ]);

        $user = User::create($validated_data);
        if (!$user) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/editors')->with('success', "Successfully create a user");
    }

    public function edit(User $user)
    {
        return view('editors.edit', [
            'user' => $user
        ]);
    }

    public function show(User $user)
    {

        return view('editors.show', [
            'user' => $user
        ]);
    }

    public function change_password(Request $request, User $user)
    {
        return view('editors.change-password', [
            'user' => $user
        ]);
    }

    public function change_password_update(Request $request, User $user)
    {
        $rules = [
            "new_password" => "required|min:3|regex:/^[a-z0-9_.]+$/i",
            "new_password_confirmation" => "required|same:new_password"
        ];
        $messages = [
            "new_password.regex" => "New password can only contains alphanumeric, _, or ."
        ];

        if (auth()->user()->id === $user->id) {
            $rules["old_password"] = "required|min:3|regex:/^[a-z0-9_.]+$/i";
            $messages["old_password.regex"] = "Old password can only contains alphanumeric, _, or .";
        }

        $validated_data = $request->validate($rules, $messages);

        if (auth()->user()->id === $user->id && isset($validated_data['old_password'])) {
            if (!Hash::check($validated_data['old_password'], $user->password)) {
                return back()->with('error', "Wrong password!");
            }
        }

        $user->update([
            'password' => Hash::make($validated_data['new_password']),
        ]);

        return redirect('/editors')->with('success', "Successfully update user password");
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "username" => "required|min:3",
        ]);

        $validator->sometimes('username', 'unique:users,username', function (Fluent $input) use ($user) {
            return $input->username !== $user->username;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        $result = $user->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/editors')->with('success', "Successfully update user");
    }

    public function destroy(User $user)
    {
        if ($user->role != 'editor') {
            return back();
        };

        $success = User::destroy($user->id);

        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/editors')->with('success', "Successfully delete a user");
    }
}

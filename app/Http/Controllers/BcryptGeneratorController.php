<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BcryptGeneratorController extends Controller
{
    public function index()
    {
        return view("password-generator");
    }

    public function get_bcrypt(Request $request)
    {
        $validated_data = $request->validate([
            "text" => "required|regex:/^[a-z0-9_.]+$/i"
        ], [
            "text.regex" => "This Value can only contains alphanumeric, _, or ."
        ]);

        $bcrypted_text = bcrypt($validated_data['text']);
        return view('password-generator', [
            "text" => $validated_data['text'],
            'bcrypted_text' => $bcrypted_text,
        ]);
    }
}

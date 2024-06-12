<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    public function index(Request $request)
    {

        $clients = Client::latest();
        if ($request->search) {
            $clients->where('name', 'LIKE', "%$request->search%");
        }
        return view('clients.index', [
            "clients" => $clients->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "slug" => "required|min:3|unique:clients,slug",
            "logo" => "required|image|file:1024"
        ]);

        $imagePath = $request->file('logo')->store('clients');
        $validated_data['logo'] = $imagePath;

        $client = Client::create($validated_data);
        if (!$client) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/clients')->with('success', "Successfully create a client");
    }

    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|min:3",
            "slug" => "required|min:3",
            "logo" => "image|file:1024"
        ]);

        $validator->sometimes('slug', 'unique:clients,slug', function (Fluent $input) use ($client) {
            return $input->slug !== $client->slug;
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated_data = $validator->validated();

        if ($request->file('logo')) {
            // delete previous file
            $filePath = public_path("images/$client->logo");
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // adding new file
            $imagePath = $request->file('logo')->store('clients');
            $validated_data['logo'] = $imagePath;
        }

        $result = $client->update($validated_data);
        if (!$result) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/clients')->with('success', "Successfully update client");
    }

    public function destroy(Client $client)
    {
        $success = Client::destroy($client->id);

        $filePath = public_path("images/$client->logo");
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        if (!$success) {
            return back()->with('error', 'Something went wrong!');
        }
        return redirect('/clients')->with('success', "Successfully delete a client");
    }

    public function create_slug(Request $request)
    {
        $slug = '';
        if ($request->name) {
            $slug = SlugService::createSlug(Client::class, 'slug', $request->name);
        }
        return response([
            'slug' => $slug
        ]);
    }
}

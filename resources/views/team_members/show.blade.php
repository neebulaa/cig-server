@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4 capitalize">Show team member: {{ $team_member->name }}</h1>
    <p class="mt-1">This page is for showing a team member</p>
    <a href="/team-members"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">

    <div class="flex flex-wrap gap-4">
        <img class="object-cover w-full rounded-full max-w-72 max-h-72 aspect-square"
            src="{{ $team_member->public_profile_image }}" alt="image-{{ $team_member->name }}" class="">
        <div class="basis-[600px]">
            <h2 class="text-xl text-blue-gray-900 font-bold mt-4 capitalize">{{ $team_member->name }}</h2>
            <p class="text-blue-gray-500 text-sm uppercase">{{ $team_member->occupation }}</p>
            <p class="mb-4 text-blue-gray-700">{{ $team_member->bio }}</p>
        </div>
    </div>
@endsection

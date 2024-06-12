@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4 capitalize">Show Benefit: {{ $benefit->title }}</h1>
    <p class="mt-1">This page is for showing a benefit</p>
    <a href="/benefits"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">

    <div class="flex flex-wrap gap-4">
        <img class="object-contain w-full bg-black rounded-lg max-w-48 max-h-48 aspect-square"
            src="{{ $benefit->public_icon }}" alt="image-{{ $benefit->title }}" class="">
        <div class="max-w-[800px]">
            <h2 class="text-xl text-blue-gray-900 font-bold capitalize mt-4">{{ $benefit->title }}</h2>
            <p class="mb-4 text-blue-gray-700">{{ $benefit->description }}</p>
        </div>
    </div>
@endsection

@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4 capitalize">Show Vision: {{ $vision->title }}</h1>
    <p class="mt-1">This page is for showing a vision</p>
    <a href="/visions"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">

    <div class="flex flex-col gap-4">
        <img class="object-cover w-full rounded-lg max-w-[400px] max-h-72 aspect-video" src="{{ $vision->public_image }}"
            alt="image-{{ $vision->title }}" class="">
        <div class="max-w-[800px]">
            <h2 class="text-xl text-blue-gray-900 font-bold capitalize mt-4">{{ $vision->title }}</h2>
            <p class="mb-4 text-blue-gray-700">{{ $vision->description }}</p>
        </div>
    </div>
@endsection

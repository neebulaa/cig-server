@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4 capitalize">Show Post: {{ $post->title }}</h1>
    <p class="mt-1">This page is for showing a post</p>
    <a href="/posts"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">

    <div class="flex flex-col gap-4">
        <img class="object-cover w-full rounded-lg max-w-[400px] max-h-72 aspect-video" src="{{ $post->public_image }}"
            alt="image-{{ $post->title }}" class="">
        <div class="max-w-[800px]">
            <h2 class="text-xl text-blue-gray-900 font-bold capitalize mt-4">{{ $post->title }}</h2>
            @if ($post->category)
                <p class="capitalize mt-1 mb-4 font-semibold text-blue-gray-500 text-sm">category:
                    {{ $post->category->name }}
                </p>
            @else
                <p class="capitalize mt-1 mb-4 font-semibold text-red-500 text-sm">
                    No Category
                </p>
            @endif
            <p class="mb-4 text-blue-gray-700">{{ $post->description }}</p>
        </div>
    </div>
@endsection

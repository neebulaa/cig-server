@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4 capitalize">Show Product: {{ $product->name }}</h1>
    <p class="mt-1">This page is for showing a product</p>
    <a href="/products"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">

    <div class="flex flex-wrap gap-4">
        <img class="object-cover rounded-lg w-full max-w-72 max-h-72 aspect-square" src="{{ $product->public_image }}"
            alt="image-{{ $product->name }}" class="">
        <div class="basis-[600px]">
            <h2 class="text-xl text-blue-gray-900 font-bold mt-4 capitalize">{{ $product->name }}</h2>
            <p class="mb-4 text-blue-gray-700">{{ $product->description }}</p>
            <p class="text-sm text-blue-gray-600">Comodities:</p>
            <div class="flex flex-wrap gap-1">
                @foreach ($product->comodities as $comodity)
                    <span
                        class="bg-black text-gray-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-gray-700 text-white dark:text-gray-400 border border-gray-500 flex items-center gap-1">
                        <img class="inline-block object-contain object-center w-5 h-5 rounded-md cursor-pointer"
                            src="{{ $comodity->public_icon }}" alt="image-{{ $comodity->name }}">
                        {{ $comodity->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4 capitalize">Show Company: {{ $company->name }}</h1>
    <p class="mt-1">This page is for showing a company</p>
    <a href="/companies"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">

    <div class="flex flex-wrap gap-4">
        <img class="object-contain w-full bg-black rounded-lg max-w-24 max-h-24 aspect-square"
            src="{{ $company->public_logo }}" alt="image-{{ $company->name }}" class="">
        <div class="basis-[600px]">
            <h2 class="text-xl text-blue-gray-900 font-bold capitalize">{{ $company->name }}</h2>
            <p class="mb-4 text-blue-gray-700">{{ $company->about }}</p>
            <p class="text-sm font-semibold text-blue-gray-800 mb-1">Company Information:</p>
            <ul class="text-sm text-blue-gray-600">
                <li>Phone Number: {{ $company->phone }}</li>
                <li>Address: {{ $company->address }}</li>
            </ul>
        </div>
    </div>
@endsection

@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">Create social</h1>
    <p class="mt-1">This page is for creating a social</p>
    <a href="/socials"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">
    <form class="p-4 border bg-white rounded-lg" method="post" action="/socials" enctype="multipart/form-data">
        @csrf
        @if (session()->has('error'))
            <div class="mt-4 mb-4">
                @include('partials.alert', [
                    'type' => 'danger',
                    'message' => session('error'),
                ])
            </div>
        @endif
        <div class="input-box">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white"
                for="company_id">Company</label>
            <select id="company_id" name="company_id"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('company_id') border-red-500 @enderror">
                <option disabled>Choose a company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', '') == $company->id ? 'selected' : '' }}>
                        {{ $company->name }}</option>
                @endforeach
            </select>
            @error('company_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white" for="type">Social
                Media Type</label>
            <select id="type" name="type"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize @error('type') border-red-500 @enderror">
                <option disabled>Choose a social media</option>
                @foreach ($social_medias as $social_media)
                    <option value="{{ $social_media }}" class="capitalize"
                        {{ old('type', '') == $social_media ? 'selected' : '' }}>{{ $social_media }}</option>
                @endforeach
            </select>
            @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white"
                for="link">Link</label>
            <input placeholder="Type something..." type="url" id="link" name="link"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('link') border-red-500 @enderror"
                value="{{ old('link', '') }}" />
            @error('link')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-white bg-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
            type="submit">Create</button>
    </form>
@endsection

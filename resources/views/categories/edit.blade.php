@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">Edit category</h1>
    <p class="mt-1">This page is for editing a category</p>
    <a href="/categories"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">
    <form class="p-4 border bg-white rounded-lg" method="post" action="/categories/{{ $category->slug }}"
        enctype="multipart/form-data">
        @method('put')
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
                for="name">Name</label>
            <input placeholder="Type something..." type="text" id="name" name="name"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') border-red-500 @enderror"
                value="{{ old('name', $category->name) }}" />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white"
                for="slug">Slug</label>
            <input placeholder="Type something..." type="text" id="slug" name="slug"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('slug') border-red-500 @enderror"
                value="{{ old('slug', $category->slug) }}" />
            @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-white bg-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
            type="submit">Edit</button>
    </form>

    <script>
        // sluggable
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch(`/categories/create_slug?name=${name.value}`).then(res => res.json()).then(data => slug.value =
                data
                .slug);
        });
    </script>
@endsection

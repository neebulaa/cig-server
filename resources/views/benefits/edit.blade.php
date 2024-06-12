@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">Edit Benefit</h1>
    <p class="mt-1">This page is for editing a benefit</p>
    <a href="/benefits"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">
    <form class="p-4 border bg-white rounded-lg" method="post" action="/benefits/{{ $benefit->slug }}"
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
                for="title">Title</label>
            <input placeholder="Type something..." type="text" id="title" name="title"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('title') border-red-500 @enderror"
                value="{{ old('title', $benefit->title) }}" />
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white"
                for="slug">Slug</label>
            <input placeholder="Type something..." type="text" id="slug" name="slug"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('slug') border-red-500 @enderror"
                value="{{ old('slug', $benefit->slug) }}" />
            @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="description">Description</label>

            <textarea cols="30" rows="3" name="description" id="description"
                class="resize-none border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $benefit->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white" for="icon">Upload
                Image</label>
            <img alt="image-preview" src="{{ $benefit->public_icon }}"
                class="bg-black image-preview w-[80px] h-[80px] p-1 max-w-full rounded-md object-contain mt-4 mb-4">
            <input
                class="image-preview-input block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('icon') border-red-500 @enderror"
                aria-describedby="file_input_help" id="icon" name="icon" type="file" accept="image/*">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">White and Transparent image: PNG
                or SVG</p>
            @error('icon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button
            class="mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-white bg-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
            type="submit">Create</button>
    </form>

    <script>
        // preview image
        const imagesPreviewInput = document.querySelectorAll('.image-preview-input');

        imagesPreviewInput.forEach((imageInput, index) => {
            imageInput.addEventListener('change', function() {
                const image = imageInput.parentElement.querySelector('.image-preview');
                if (image && imageInput.files.length) {
                    image.src = URL.createObjectURL(imageInput.files[0]);
                    image.classList.remove('hidden');
                    image.classList.add('block');
                    image.classList.add('bg-black');
                }
            });
        });

        // sluggable
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch(`/benefits/create_slug?title=${title.value}`).then(res => res.json()).then(data => slug.value =
                data
                .slug);
        });
    </script>
@endsection

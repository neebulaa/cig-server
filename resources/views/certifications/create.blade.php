@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">Create Certification</h1>
    <p class="mt-1">This page is for creating a certification</p>
    <a href="/certifications"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">
    <form class="p-4 border bg-white rounded-lg" method="post" action="/certifications" enctype="multipart/form-data">
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
                value="{{ old('title', '') }}" />
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white"
                for="slug">Slug</label>
            <input placeholder="Type something..." type="text" id="slug" name="slug"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('slug') border-red-500 @enderror"
                value="{{ old('slug', '') }}" />
            @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="description">Description</label>

            <textarea cols="30" rows="3" name="description" id="description"
                class="resize-none border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', '') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white" for="image">Upload
                Image</label>
            <img alt="image-preview"
                class="image-preview w-72 aspect-video p-1 max-w-full rounded-md object-cover mt-4 mb-4 hidden">
            <input
                class="image-preview-input block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 @error('image') border-red-500 @enderror"
                aria-describedby="file_input_help" id="image" name="image" type="file" accept="image/*">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG, or JPEG</p>
            @error('image')
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
                    image.classList.add('bg-gray-100');
                }
            });
        });

        // sluggable
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch(`/certifications/create_slug?title=${title.value}`).then(res => res.json()).then(data => slug
                .value =
                data
                .slug);
        });
    </script>
@endsection

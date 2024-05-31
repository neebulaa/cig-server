@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">Main Page</h1>
    <p class="mb-2 mt-4">Section lists</p>
    <div class="mt-2 flex flex-wrap gap-2">
        @foreach ($pageContents as $section => $contents)
            <a href="#{{ $section }}"
                class="align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">{{ implode(' ', explode('_', $section)) }}</a>
        @endforeach
    </div>
    <hr class="mt-4 mb-4">
    <div>
        @foreach ($pageContents as $section => $contents)
            <section class="[&:not(:first-child)]:mt-12" id="{{ $section }}">
                <h2 class="text-lg capitalize font-semibold">{{ $loop->iteration }}.
                    {{ implode(' ', explode('_', $section)) }}
                    Section</h2>
                <div class="mt-4 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr))">
                    @foreach ($contents as $content)
                        <form action="" class="p-4 border bg-white rounded-lg">
                            <p class="font-semibold font-sans mb-1 capitalize">{{ $content['title'] }}</p>
                            <div>
                                @foreach ($content['values'] as $value)
                                    <div class="[&:not(:first-child)]:mt-4">
                                        <label for="login-username"
                                            class="capitalize block antialiased font-sans leading-normal text-blue-gray-900 mb-2 font-medium">
                                            {{ $value['type'] }}:</label>

                                        @if ($content['type'] == 'text' || $content['type'] == 'button')
                                            <input placeholder="Type something..." type="text"
                                                class="w-full bg-transparent text-blue-gray-700 font-sans font-normal border focus:border-2 text-sm px-3 py-3 rounded-md border-blue-gray-200 focus:border-gray-900 @error('username') border-red-500 @enderror"
                                                value="{{ $value['value'] }}" />
                                        @elseif ($content['type'] == 'textarea')
                                            <textarea cols="30" rows="10"
                                                class="resize-none w-full bg-transparent text-blue-gray-700 font-sans font-normal border focus:border-2 text-sm px-3 py-3 rounded-md border-blue-gray-200 focus:border-gray-900 @error('username') border-red-500 @enderror">{{ $value['value'] }}</textarea>
                                        @endif
                                        @error('username')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            <button
                                class="mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-white bg-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
                                type="submit">Save Content</button>
                        </form>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
@endsection

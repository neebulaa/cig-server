@extends('layouts.main')
@section('content')
    <style>
        #map {
            position: relative;
            background: #111;
            width: 100%;
            max-width: 800px;
            margin: auto;
            aspect-ratio: 16 / 9;
            z-index: 1;
            box-sizing: border-box;
        }

        #map-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            opacity: .4;
        }

        .pinpoint-draggable {
            z-index: 1;
            position: absolute;
            width: 30px;
            top: calc(var(--top-percent) * 1%);
            left: calc(var(--left-percent) * 1%);
        }

        .pinpoint-draggable>img {
            filter: drop-shadow(0 0 3px white);
            display: block;
            width: 100%;
        }

        .pinpoint-draggable .comodities {
            width: 12px;
            height: 12px;
        }

        .pinpoint-draggable .comodities img {
            position: absolute;
            z-index: 10;
            width: 12px;
            opacity: 0;
            height: 12px;
            animation: fadeInAndOut calc(var(--total) * 2s) calc(var(--order) * 2s) linear infinite;
        }

        .pinpoint-draggable:has(*:not(.identifier):not(.identifier *):hover) .identifier {
            opacity: 1;
            display: block;
        }

        .pinpoint-draggable .identifier {
            display: none;
            text-align: center;
            left: 50%;
            translate: -50%;
            top: 105%;
            width: 150px;
            position: absolute;
            padding: .5rem;
            border: 1px solid gray;
            background: #111;
            border-radius: 8px;
        }

        .pinpoint-draggable .identifier::before {
            content: '';
            position: absolute;
            top: -10px;
            width: 10px;
            height: 10px;
            background: var(--color);
            clip-path: polygon(50% 0, 50% 0, 100% 100%, 0 100%);
            left: 50%;
            translate: -50%;
        }

        @keyframes fadeInAndOut {

            0%,
            20%,
            100% {
                opacity: 0;
            }

            10% {
                opacity: 1;
            }
        }
    </style>

    <section class="grid gap-4" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
        <div
            class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 border border-blue-gray-100 shadow-sm">
            <div
                class="bg-clip-border mt-4 mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-gray-900/20 absolute grid h-12 w-12 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 text-white" fill="currentColor">
                    <path
                        d="M352 256c0 22.2-1.2 43.6-3.3 64H163.3c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64H348.7c2.2 20.4 3.3 41.8 3.3 64zm28.8-64H503.9c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64H380.8c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32H376.7c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0H167.7c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0H18.6C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192H131.2c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64H8.1C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6H344.3c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352H135.3zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6H493.4z" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Regions</p>
                <h4
                    class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                    {{ $regions->count() }}</h4>
            </div>
            <div class="border-t border-blue-gray-50 p-4">
                <a href="/regions"
                    class="block align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">view
                    regions</a>
            </div>
        </div>
        <div
            class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 border border-blue-gray-100 shadow-sm">
            <div
                class="bg-clip-border mt-4 mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-gray-900/20 absolute grid h-12 w-12 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-6 h-6 text-white"
                    fill="currentColor">
                    <path
                        d="M88.7 223.8L0 375.8V96C0 60.7 28.7 32 64 32H181.5c17 0 33.3 6.7 45.3 18.7l26.5 26.5c12 12 28.3 18.7 45.3 18.7H416c35.3 0 64 28.7 64 64v32H144c-22.8 0-43.8 12.1-55.3 31.8zm27.6 16.1C122.1 230 132.6 224 144 224H544c11.5 0 22 6.1 27.7 16.1s5.7 22.2-.1 32.1l-112 192C453.9 474 443.4 480 432 480H32c-11.5 0-22-6.1-27.7-16.1s-5.7-22.2 .1-32.1l112-192z" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Posts</p>
                <h4
                    class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                    {{ $posts->count() }}</h4>
            </div>
            <div class="border-t border-blue-gray-50 p-4">
                <a href="/posts"
                    class="block align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">view
                    posts</a>
            </div>
        </div>
        <div
            class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 border border-blue-gray-100 shadow-sm">
            <div
                class="bg-clip-border mt-4 mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-gray-900/20 absolute grid h-12 w-12 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-6 h-6 text-white"
                    fill="currentColor">
                    <path
                        d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Certifications
                </p>
                <h4
                    class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                    {{ $certifications->count() }}</h4>
            </div>
            <div class="border-t border-blue-gray-50 p-4">
                <a href="/certifications"
                    class="block align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">view
                    certifications</a>
            </div>
        </div>
        <div
            class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 border border-blue-gray-100 shadow-sm">
            <div
                class="bg-clip-border mt-4 mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-gray-900/20 absolute grid h-12 w-12 place-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 text-white"
                    fill="currentColor">
                    <path
                        d="M500.3 7.3C507.7 13.3 512 22.4 512 32V176c0 26.5-28.7 48-64 48s-64-21.5-64-48s28.7-48 64-48V71L352 90.2V208c0 26.5-28.7 48-64 48s-64-21.5-64-48s28.7-48 64-48V64c0-15.3 10.8-28.4 25.7-31.4l160-32c9.4-1.9 19.1 .6 26.6 6.6zM74.7 304l11.8-17.8c5.9-8.9 15.9-14.2 26.6-14.2h61.7c10.7 0 20.7 5.3 26.6 14.2L213.3 304H240c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V352c0-26.5 21.5-48 48-48H74.7zM192 408a48 48 0 1 0 -96 0 48 48 0 1 0 96 0zM478.7 278.3L440.3 368H496c6.7 0 12.6 4.1 15 10.4s.6 13.3-4.4 17.7l-128 112c-5.6 4.9-13.9 5.3-19.9 .9s-8.2-12.4-5.3-19.2L391.7 400H336c-6.7 0-12.6-4.1-15-10.4s-.6-13.3 4.4-17.7l128-112c5.6-4.9 13.9-5.3 19.9-.9s8.2 12.4 5.3 19.2zm-339-59.2c-6.5 6.5-17 6.5-23 0L19.9 119.2c-28-29-26.5-76.9 5-103.9c27-23.5 68.4-19 93.4 6.5l10 10.5 9.5-10.5c25-25.5 65.9-30 93.9-6.5c31 27 32.5 74.9 4.5 103.9l-96.4 99.9z" />
                </svg>
            </div>
            <div class="p-4 text-right">
                <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600">Categories</p>
                <h4
                    class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900">
                    {{ $categories->count() }}</h4>
            </div>
            <div class="border-t border-blue-gray-50 p-4">
                <a href="/categories"
                    class="block align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">view
                    categories</a>
            </div>
        </div>
    </section>

    <section class="mt-8">
        <div class="flex justify-between items-center flex-wrap gap-4 mb-4">
            <div class="flex flex-col">
                <h6
                    class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900">
                    The Pinpoints</h6>
                <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-500">Here is all the
                    currently active pinpoints</p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="/pinpoints"
                    class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Set
                    pinpoints now</a>
                <a href="/regions"
                    class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Add
                    region now</a>
            </div>
        </div>
        <div class="bg-[#111] rounded-md overflow-hidden">
            <div id="map" class="rounded overflow-hidden">
                {{-- <img src="{{ asset('images/map-pin.png') }}" alt="pin map" id="pinpoint-draggable" draggable="false"> --}}
                @foreach ($pinpoints as $pinpoint)
                    @if ($pinpoint->region->type === 'province')
                        <div id="pinpoint-draggable-{{ $pinpoint->region->slug }}"
                            class="pinpoint-draggable {{ $pinpoint->is_active ? 'opacity-100 !z-10' : 'opacity-0' }}">
                            <img src="{{ asset('images/province-pin.png') }}" alt="pin map" draggable="false">
                            @if ($pinpoint->region->comodities->count())
                                <div class="comodities absolute top-1 left-1/2 -translate-x-1/2"
                                    style="--total: {{ $pinpoint->region->comodities->count() }}">
                                    @foreach ($pinpoint->region->comodities as $index => $comodity)
                                        <img src="{{ $comodity->public_icon }}" alt="image-{{ $comodity->name }}"
                                            style="--order: {{ $index }}">
                                    @endforeach
                                </div>
                            @endif

                            <div class="identifier text-xs" style="--color: #31c48d;">
                                <p class="capitalize text-green-400">
                                    {{ $pinpoint->region->type }}</p>
                                <p class="text-white font-semibold">{{ $pinpoint->region->name }}</p>
                                @if ($pinpoint->region->comodities->count())
                                    <p class="mt-4 text-white capitalize mb-1">
                                        Comodities:
                                    </p>
                                    <div class="flex flex-wrap gap-2 justify-center">
                                        @foreach ($pinpoint->region->comodities as $index => $comodity)
                                            <img src="{{ $comodity->public_icon }}" alt="image-{{ $comodity->name }}"
                                                class="w-4 h-4">
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($pinpoint->region->type === 'harbor')
                        <div id="pinpoint-draggable-{{ $pinpoint->region->slug }}"
                            class="pinpoint-draggable {{ $pinpoint->is_active ? 'opacity-100 !z-10' : 'opacity-0' }}">
                            <img src="{{ asset('images/harbor-pin.png') }}" alt="pin map" draggable="false">

                            <div class="identifier text-xs" style="--color: #111;">
                                <p class="capitalize text-red-400">
                                    {{ $pinpoint->region->type }}</p>
                                <p class="text-white font-semibold">{{ $pinpoint->region->name }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
                <img src="{{ asset('images/map-white.png') }}" alt="white map" id="map-img" />
            </div>
        </div>
        <script>
            let pinpointMap = document.querySelector("#map");
            let pinpoinMapRect = pinpointMap.getBoundingClientRect();
        </script>
        @foreach ($pinpoints as $pinpoint)
            <style>
                #pinpoint-draggable-{{ $pinpoint->region->slug }} {
                    --top-px: 0;
                    --left-px: 0;
                    --top-percent: 0;
                    --left-percent: 0;
                }
            </style>
            <script>
                window.addEventListener('load', function() {
                    let posXCoordinate{{ $pinpoint->id }} = parseFloat({{ $pinpoint->pos_x }});
                    let posYCoordinate{{ $pinpoint->id }} = parseFloat({{ $pinpoint->pos_y }});
                    let pinpointDraggableImage{{ $pinpoint->id }} = document.querySelector(
                        '#{{ 'pinpoint-draggable-' . $pinpoint->region->slug }}');
                    let pinpointDraggableImageRect{{ $pinpoint->id }} = pinpointDraggableImage{{ $pinpoint->id }}
                        .getBoundingClientRect();

                    (pinpointDraggableImage{{ $pinpoint->id }})
                    .style.setProperty('--top-percent', posYCoordinate{{ $pinpoint->id }} -
                        (pinpointDraggableImageRect{{ $pinpoint->id }}).height /
                        pinpoinMapRect.height * 100);

                    (pinpointDraggableImage{{ $pinpoint->id }}).style.setProperty('--top-px', (
                        posYCoordinate{{ $pinpoint->id }} -
                        (pinpointDraggableImageRect{{ $pinpoint->id }}).height /
                        pinpoinMapRect.height * 100) / 100 * pinpoinMapRect.height);

                    (pinpointDraggableImage{{ $pinpoint->id }}).style.setProperty('--left-percent',
                        posXCoordinate{{ $pinpoint->id }} -
                        ((pinpointDraggableImageRect{{ $pinpoint->id }}).width / 2) /
                        pinpoinMapRect.width * 100);

                    (pinpointDraggableImage{{ $pinpoint->id }}).style.setProperty('--left-px', (
                        posXCoordinate{{ $pinpoint->id }} - (
                            (pinpointDraggableImageRect{{ $pinpoint->id }}).width / 2) /
                        pinpoinMapRect.width * 100) / 100 * pinpoinMapRect.width);
                });
            </script>
        @endforeach
    </section>

    <section class="mt-8">
        <div class="flex justify-between items-center flex-wrap gap-4 mb-4">
            <div class="flex flex-col">
                <h6
                    class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900">
                    Products</h6>
                <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-500">All the
                    delighted products</p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="/products"
                    class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">See
                    more in management</a>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-12 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($products->slice(0, 4) as $index => $product)
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-transparent text-gray-700 shadow-none">
                    <div
                        class="relative bg-clip-border rounded-xl overflow-hidden bg-gray-900 text-white shadow-gray-900/20 shadow-lg mx-0 mt-0 mb-4 h-64 xl:h-40">
                        <img src="{{ $product->public_image }}" alt="image-{{ $product->name }}"
                            class="h-full w-full object-cover">
                    </div>
                    <div class="p-6 py-0 px-1">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-500">
                            Product
                            #{{ $index + 1 }}</p>
                        <h5
                            class="block antialiased tracking-normal font-sans text-xl font-semibold leading-snug text-blue-gray-900 mt-1 mb-2 whitespace-nowrap text-ellipsis overflow-x-hidden">
                            {{ $product->name }}</h5>

                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-500">
                            {{ substr($product->description, 0, 50) }}
                            {{ strlen($product->description) > 50 ? '...' : '' }}</p>

                        @if ($product->comodities->count())
                            <p class="text-sm mt-4 mb-1">Comodities:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach ($product->comodities as $comodity)
                                    <a href="/comodities?search={{ $comodity->name }}"
                                        class="bg-black text-gray-800 text-xs font-medium px-1 py-1 rounded-full dark:bg-gray-700 text-white dark:text-gray-400 border border-gray-500 flex items-center gap-1">
                                        <img class="inline-block object-contain object-center w-4 h-4 rounded-md cursor-pointer"
                                            src="{{ $comodity->public_icon }}" alt="image-{{ $comodity->name }}">
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        <a href="/products/{{ $product->slug }}"
                            class=" mt-4 block align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">view
                            product</a>
                    </div>
                </div>
            @endforeach
        </div>

    </section>

    <section class="mt-8">
        <div class="flex justify-between items-center flex-wrap gap-4 mb-4">
            <div class="flex flex-col">
                <h6
                    class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900">
                    Posts</h6>
                <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-500">Latest Posts
                </p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="/posts"
                    class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">See
                    more in management</a>
            </div>
        </div>
        <div class="mt-6 grid grid-cols-1 gap-12 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($posts->slice(0, 4) as $index => $post)
                <div class="relative flex flex-col bg-clip-border rounded-xl bg-transparent text-gray-700 shadow-none">
                    <div
                        class="relative bg-clip-border rounded-xl overflow-hidden bg-gray-900 text-white shadow-gray-900/20 shadow-lg mx-0 mt-0 mb-4 h-64 xl:h-40">
                        <img src="{{ $post->public_image }}" alt="image-{{ $post->name }}"
                            class="h-full w-full object-cover">
                    </div>
                    <div class="p-6 py-0 px-1">
                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-500">Post
                            #{{ $index + 1 }}</p>
                        <h5
                            class="block antialiased tracking-normal font-sans text-xl font-semibold leading-snug text-blue-gray-900 mt-1 whitespace-nowrap text-ellipsis overflow-x-hidden mb-1">
                            {{ $post->title }}</h5>

                        @if ($post->category)
                            <p class="mb-2 capitalize font-semibold text-sm text-gray-600">
                                <a href="/categories?search={{ $post->category->slug }}">
                                    Category: {{ $post->category->name }}
                                </a>
                            </p>
                        @else
                            <p class="mb-2 capitalize font-semibold text-sm text-red-600">
                                No Category
                            </p>
                        @endif

                        <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-500">
                            {{ substr($post->description, 0, 50) }}
                            {{ strlen($post->description) > 50 ? '...' : '' }}</p>

                        <a href="/posts/{{ $post->slug }}"
                            class=" mt-4 block align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">view
                            post</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

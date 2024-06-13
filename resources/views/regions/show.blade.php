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

        .pinpoint-draggable .identifier {
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
            display: none;
        }

        .pinpoint-draggable:has(*:not(.identifier):not(.identifier > *):hover) .identifier {
            display: block;
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

        #pinpoint-draggable {
            --top-px: 0;
            --left-px: 0;
            --top-percent: 0;
            --left-percent: 0;
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
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4 capitalize">Show region: {{ $region->name }}</h1>
    <p class="mt-1">This page is for showing a region</p>
    <a href="/regions"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">

    <div class="flex flex-col gap-4">
        <div class="bg-[#111] rounded-md overflow-hidden">
            <div id="map">
                @if ($region->type === 'province')
                    <div id="pinpoint-draggable" class="pinpoint-draggable opacity-100 !z-10">
                        <img src="{{ asset('images/province-pin.png') }}" alt="pin map" draggable="false">
                        @if ($region->comodities->count())
                            <div class="comodities absolute top-1 left-1/2 -translate-x-1/2"
                                style="--total: {{ $region->comodities->count() }}">
                                @foreach ($region->comodities as $index => $comodity)
                                    <img src="{{ $comodity->public_icon }}" alt="image-{{ $comodity->name }}"
                                        style="--order: {{ $index }}">
                                @endforeach
                            </div>
                        @endif

                        <div class="identifier text-xs" style="--color: #31c48d;">
                            <p class="capitalize text-green-400">
                                {{ $region->type }}</p>
                            <p class="text-white font-semibold">{{ $region->name }}</p>
                            @if ($region->comodities->count())
                                <p class="mt-4 text-white capitalize mb-1">
                                    Comodities:
                                </p>
                                <div class="flex flex-wrap gap-2 justify-center">
                                    @foreach ($region->comodities as $index => $comodity)
                                        <img src="{{ $comodity->public_icon }}" alt="image-{{ $comodity->name }}"
                                            class="w-4 h-4">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if ($region->type === 'harbor')
                    <div id="pinpoint-draggable" class="pinpoint-draggable opacity-100 !z-10">
                        <img src="{{ asset('images/harbor-pin.png') }}" alt="pin map" draggable="false">

                        <div class="identifier text-xs" style="--color: #111;">
                            <p class="capitalize text-red-400">
                                {{ $region->type }}</p>
                            <p class="text-white font-semibold">{{ $region->name }}</p>
                        </div>
                    </div>
                @endif
                <img src="{{ asset('images/map-white.png') }}" alt="white map" id="map-img" />
            </div>
        </div>
        <script>
            window.addEventListener('load', function() {
                let pinpointMap = document.querySelector("#map");
                let pinpoinMapRect = pinpointMap.getBoundingClientRect();
                let posXCoordinate = parseFloat({{ $region->pinpoint->pos_x }});
                let posYCoordinate = parseFloat({{ $region->pinpoint->pos_y }});
                let pinpointDraggableImage = document.querySelector(
                    '#pinpoint-draggable');
                let pinpointDraggableImageRect =
                    pinpointDraggableImage
                    .getBoundingClientRect();

                (pinpointDraggableImage)
                .style.setProperty('--top-percent', posYCoordinate -
                    (pinpointDraggableImageRect).height /
                    pinpoinMapRect.height * 100);

                (pinpointDraggableImage).style.setProperty('--top-px', (
                    posYCoordinate -
                    (pinpointDraggableImageRect).height /
                    pinpoinMapRect.height * 100) / 100 * pinpoinMapRect.height);

                (pinpointDraggableImage).style.setProperty('--left-percent',
                    posXCoordinate -
                    ((pinpointDraggableImageRect).width / 2) /
                    pinpoinMapRect.width * 100);

                (pinpointDraggableImage).style.setProperty('--left-px', (
                    posXCoordinate - (
                        (pinpointDraggableImageRect).width / 2) /
                    pinpoinMapRect.width * 100) / 100 * pinpoinMapRect.width);
            });
        </script>

        <div class="basis-[600px]">
            <h2 class="text-xl text-blue-gray-900 font-bold mt-4 capitalize">{{ $region->name }}</h2>
            <p class="capitalize mb-2 font-semibold text-blue-gray-500 text-sm">{{ $region->type }}
            </p>
            <p class="mb-4 text-blue-gray-700">{{ $region->description }}</p>
            @if ($region->type === 'province')
                <p class="text-sm text-blue-gray-600">Comodities:</p>
                <div class="flex flex-wrap gap-1">
                    @foreach ($region->comodities as $comodity)
                        <span
                            class="bg-black text-gray-800 text-xs font-medium px-2.5 py-1 rounded dark:bg-gray-700 text-white dark:text-gray-400 border border-gray-500 flex items-center gap-1">
                            <img class="inline-block object-contain object-center w-5 h-5 rounded-md cursor-pointer"
                                src="{{ $comodity->public_icon }}" alt="image-{{ $comodity->name }}">
                            {{ $comodity->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection

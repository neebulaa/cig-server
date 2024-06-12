@extends('layouts.main')
@section('content')
    <style>
        #map {
            position: relative;
            background: #111;
            width: 100%;
            max-width: 800px;
            z-index: 1;
            aspect-ratio: 16 / 9;
            box-sizing: border-box;
            margin: auto;
        }

        #map-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            opacity: .4;
        }

        #pinpoint-draggable {
            filter: drop-shadow(0 0 3px white);
            z-index: 10;
            --top-px: 0;
            --left-px: 0;
            --top-percent: 0;
            --left-percent: 0;
            position: absolute;
            width: 30px;
            top: calc(var(--top-percent) * 1%);
            left: calc(var(--left-percent) * 1%);
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
                {{-- <img src="{{ asset('images/map-pin.png') }}" alt="pin map" id="pinpoint-draggable" draggable="false"> --}}
                @if ($region->type === 'province')
                    <img src="{{ asset('images/province-pin.png') }}" alt="pin map" id="pinpoint-draggable"
                        draggable="false">
                @endif

                @if ($region->type === 'harbor')
                    <img src="{{ asset('images/harbor-pin.png') }}" alt="pin map" id="pinpoint-draggable"
                        draggable="false">
                @endif
                <img src="{{ asset('images/map-white.png') }}" alt="white map" id="map-img" />
            </div>
        </div>
        <script>
            let posXCoordinate = parseFloat({{ $region->pinpoint->pos_x }});
            let posYCoordinate = parseFloat({{ $region->pinpoint->pos_y }});
            let pinpointMap = document.querySelector("#map");
            let pinpointDraggableImage = document.querySelector("#pinpoint-draggable")
            let pinpointDraggableImageRect = pinpointDraggableImage.getBoundingClientRect();
            let pinpoinMapRect = pinpointMap.getBoundingClientRect();

            pinpointDraggableImage.style.setProperty('--top-percent', posYCoordinate - pinpointDraggableImageRect.height /
                pinpoinMapRect.height * 100);
            pinpointDraggableImage.style.setProperty('--top-px', (posYCoordinate - pinpointDraggableImageRect.height /
                pinpoinMapRect.height * 100) / 100 * pinpoinMapRect.height);
            pinpointDraggableImage.style.setProperty('--left-percent', posXCoordinate - (pinpointDraggableImageRect.width / 2) /
                pinpoinMapRect.width * 100);
            pinpointDraggableImage.style.setProperty('--left-px', (posXCoordinate - (pinpointDraggableImageRect.width / 2) /
                pinpoinMapRect.width * 100) / 100 * pinpoinMapRect.width);
        </script>

        <div class="basis-[600px]">
            <h2 class="text-xl text-blue-gray-900 font-bold mt-4 capitalize">{{ $region->name }}</h2>
            <p class="capitalize mb-2 font-semibold text-blue-gray-500 text-sm">Type: {{ $region->type }}
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

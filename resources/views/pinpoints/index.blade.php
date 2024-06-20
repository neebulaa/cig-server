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
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">All Pinpoints</h1>
    <p class="mt-1">This page is for managing all pinpoints</p>
    @if (session()->has('success'))
        <div class="mt-4 mb-4">
            @include('partials.alert', [
                'type' => 'success',
                'message' => session('success'),
            ])
        </div>
    @endif
    <hr class="mt-4 mb-4">
    <div class="bg-[#111] rounded-md overflow-hidden">
        <div id="map" class="rounded overflow-hidden">
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

    <h2 class="mt-5 text-lg font-bold mb-2">Pinpoints</h2>

    @include('partials.search', [
        'page' => 'pinpoints',
    ])
    @if ($filtered_pinpoints->count())
        <form onsubmit="updatePinpoints(event)" class="mt-4">
            <div class="max-h-[500px] overflow-y-auto">
                <div class="grid gap-6 p-1" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))">
                    @foreach ($filtered_pinpoints as $pinpoint)
                        <div class="flex">
                            <div class="flex items-center h-5">
                                <input id="pinpoint-{{ $pinpoint->region->slug }}" aria-describedby="helper-checkbox-text"
                                    type="checkbox" value="active" name="pinpoint={{ $pinpoint->region->slug }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    {{ $pinpoint->is_active ? 'checked' : '' }}>
                            </div>
                            <div class="ms-2 text-sm">
                                <label for="pinpoint-{{ $pinpoint->region->slug }}"
                                    class="font-medium text-gray-900 dark:text-gray-300 select-none cursor-pointer"><span
                                        class="capitalize {{ $pinpoint->region->type == 'province' ? 'text-green-700' : 'text-red-700' }}">{{ $pinpoint->region->type }}</span>:
                                    {{ $pinpoint->region->name }}</label>
                                <p class="text-xs font-normal text-gray-500 dark:text-gray-300">
                                    {{ substr($pinpoint->region->description, 0, 30) }}
                                    {{ strlen($pinpoint->region->description) > 30 ? '...' : '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="py-4 pt-6">
                <button
                    class="block w-max align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Update
                    Map</button>
            </div>
        </form>
    @else
        <h3 class="text-lg text-blue-gray-900 font-bold mt-4">Currently there is no pin point
            {{ request('search') ? 'with keyword ' . request('search') : '' }}</h3>
        <p>Please add some data</p>
    @endif

    <script>
        async function updatePinpoints(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            let body = getJsonFromFormData(formData);
            const slugs = [];
            Object.keys(body).forEach(key => {
                const [k, slug] = key.split('=');
                slugs.push(slug);
            });
            const response = await fetching('PUT', `/api/pinpoints`, {
                body: JSON.stringify({
                    slugs
                }),
            });
            if (response.status == 422) {
                Toast.open('danger', response.data.message);
            } else if (response.status == 200) {
                const pinpoints = document.querySelectorAll('.pinpoint-draggable');
                pinpoints.forEach(pinpoint => {
                    pinpoint.classList.add('opacity-0');
                    pinpoint.classList.remove('opacity-100');
                    pinpoint.classList.remove('!z-10');
                });
                slugs.forEach(slug => {
                    const pinpoint = document.querySelector(`#pinpoint-draggable-${ slug }`);
                    pinpoint.classList.add('opacity-100');
                    pinpoint.classList.add('!z-10');
                    pinpoint.classList.remove('opacity-0');
                });
                Toast.open('success', response.data.message);
            }
        }
    </script>
@endsection

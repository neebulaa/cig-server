@extends('layouts.main')

@section('content')
    <style>
        #map {
            position: relative;
            background: #111;
            width: 100%;
            max-width: 800px;
            aspect-ratio: 16 / 9;
            box-sizing: border-box;
            z-index: 1;
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
            display: none;
            --top-px: 0;
            --left-px: 0;
            --top-percent: 0;
            --left-percent: 0;
            position: absolute;
            cursor: pointer;
            width: 40px;
            top: calc(var(--top-percent) * 1%);
            left: calc(var(--left-percent) * 1%);
        }
    </style>

    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">Edit Region</h1>
    <p class="mt-1">This page is for editing a region</p>
    <a href="/regions"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Back
        to index</a>
    <hr class="mt-4 mb-4">
    <form class="p-4 border bg-white rounded-lg" method="post" action="/regions/{{ $region->slug }}"
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
                value="{{ old('name', $region->name) }}" />
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white"
                for="slug">Slug</label>
            <input placeholder="Type something..." type="text" id="slug" name="slug"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('slug') border-red-500 @enderror"
                value="{{ old('slug', $region->slug) }}" />
            @error('slug')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white"
                for="type">Type</label>
            <select id="type" name="type"
                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 capitalize @error('type') border-red-500 @enderror">
                <option disabled>Choose a type</option>
                <option value="province" class="capitalize"
                    {{ old('type', $region->type) == 'province' ? 'selected' : '' }}>Province
                </option>
                <option value="harbor" class="capitalize" {{ old('type', $region->type) == 'harbor' ? 'selected' : '' }}>
                    Harbor
                </option>
            </select>
            @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4 {{ old('type', $region->type) == 'province' ? 'block' : 'hidden' }}"
            id="comodities-selection-input">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="comodities">Product
                comodities</label>

            <select multiple id="comodities" name="comodities[]"
                class="h-[150px] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('comodities') border-red-500 @enderror">
                <option disabled>Choose categories</option>
                @foreach ($comodities as $comodity)
                    <option value="{{ $comodity->slug }}" class="capitalize py-0.5"
                        {{ in_array($comodity->slug, old('comodities', $region->comodities->map(fn($c) => $c->slug)->toArray())) ? 'selected' : '' }}>
                        {{ $comodity->name }}
                    </option>
                @endforeach
            </select>
            @error('comodities')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                for="description">Description</label>

            <textarea cols="30" rows="3" name="description" id="description"
                class="resize-none border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $region->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-box mt-4">
            <label class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white" for="image">Set
                Pinpoint</label>
            <input type="hidden" value="{{ old('pos-x', $region->pinpoint?->pos_x) }}" id="pos-x" name="pos-x">
            <input type="hidden" value="{{ old('pos-y', $region->pinpoint?->pos_y) }}" id="pos-y" name="pos-y">

            <div id="map"
                class="rounded overflow-hidden @error('pos-x') border border-red-500 @enderror @error('pos-y') border border-red-500 @enderror">
                <img src="{{ asset('images/map-pin.png') }}" alt="pin map" id="pinpoint-draggable" draggable="false"
                    style="display: block;" />
                <img src="{{ asset('images/map-white.png') }}" alt="white map" id="map-img" />
            </div>
            @if (old('pos-x', $region->pinpoint?->pos_x) || old('pos-y', $region->pinpoint?->pos_y))
                <script>
                    let posXCoordinate = parseFloat({{ old('pos-x', $region->pinpoint?->pos_x) }});
                    let posYCoordinate = parseFloat({{ old('pos-y', $region->pinpoint?->pos_y) }});
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
            @endif

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Click the map and drag the
                pinpoint to the designated location</p>
            @error('pos-x')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @error('pos-y')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button
            class="mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-white bg-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]"
            type="submit">Edit</button>
    </form>

    <script>
        // comodities selection input
        const typeSelection = document.querySelector('#type');
        const comoditySelectionInput = document.querySelector('#comodities-selection-input');
        typeSelection.addEventListener('input', function() {
            if (typeSelection.value == 'province') {
                comoditySelectionInput.style.display = 'block';
            } else {
                comoditySelectionInput.style.display = 'none';
            }
        });


        // pinpoint draggable
        const map = document.querySelector("#map");
        const posX = document.querySelector('#pos-x');
        const posY = document.querySelector('#pos-y');
        const pinpoint = document.querySelector("#pinpoint-draggable");

        const movement = {
            x: 0,
            y: 0,
            click: false,
        };

        map.addEventListener('mousedown', function(e) {
            if (e.target.id == 'map-img') {
                pinpoint.style.display = 'block';
                const mapRect = map.getBoundingClientRect();
                const pinpointRect = pinpoint.getBoundingClientRect();
                movement.x = e.clientX;
                movement.y = e.clientY;

                let newXPx = e.offsetX - pinpointRect.width / 2;
                let newYPx = e.offsetY - pinpointRect.height;

                // check if pinpoint already exceed map box
                if (newXPx <= 0) {
                    newXPx = 0;
                }

                if (newXPx + pinpointRect.width >= mapRect.width) {
                    newXPx = mapRect.width - pinpointRect.width;
                }

                if (newYPx <= 0) {
                    newYPx = 0;
                }

                if (newYPx + pinpointRect.height >= mapRect.height) {
                    newYPx = mapRect.height - pinpointRect.height;
                }

                const newXPercent = (newXPx / mapRect.width) * 100;
                const newYPercent = (newYPx / mapRect.height) * 100;

                posX.value = newXPercent + ((pinpointRect.width / 2) / mapRect.width * 100);
                posY.value = newYPercent + (pinpointRect.height / mapRect.height * 100);

                setCustomElementProperty(pinpoint, "--top-px", newYPx);
                setCustomElementProperty(pinpoint, "--left-px", newXPx);
                setCustomElementProperty(
                    pinpoint,
                    "--left-percent",
                    newXPercent
                );
                setCustomElementProperty(
                    pinpoint,
                    "--top-percent",
                    newYPercent
                );
            }
        });

        pinpoint.addEventListener("mousedown", function(e) {
            movement.click = true;
            movement.x = e.clientX;
            movement.y = e.clientY;
        });

        pinpoint.addEventListener("mouseup", function(e) {
            movement.click = false;
        });

        map.addEventListener("mouseleave", function(e) {
            movement.click = false;
        });

        map.addEventListener("mousemove", function(e) {
            if (!movement.click) return;
            const mapRect = map.getBoundingClientRect();
            const pinpointRect = pinpoint.getBoundingClientRect();

            const xDelta = e.clientX - movement.x;
            const yDelta = e.clientY - movement.y;

            const prevYPx = parseInt(
                getCustomProperty(pinpoint, "--top-px")
            );
            const prevXPx = parseInt(
                getCustomProperty(pinpoint, "--left-px")
            );

            let newXPx = xDelta + prevXPx;
            let newYPx = yDelta + prevYPx;

            // check if pinpoint already exceed map box
            if (newXPx <= 0) {
                newXPx = 0;
            }

            if (newXPx + pinpointRect.width >= mapRect.width) {
                newXPx = mapRect.width - pinpointRect.width;
            }

            if (newYPx <= 0) {
                newYPx = 0;
            }

            if (newYPx + pinpointRect.height >= mapRect.height) {
                newYPx = mapRect.height - pinpointRect.height;
            }

            const newXPercent = (newXPx / mapRect.width) * 100;
            const newYPercent = (newYPx / mapRect.height) * 100;

            posX.value = newXPercent + ((pinpointRect.width / 2) / mapRect.width * 100);
            posY.value = newYPercent + (pinpointRect.height / mapRect.height * 100);

            setCustomElementProperty(pinpoint, "--top-px", newYPx);
            setCustomElementProperty(pinpoint, "--left-px", newXPx);
            setCustomElementProperty(
                pinpoint,
                "--left-percent",
                newXPercent
            );
            setCustomElementProperty(
                pinpoint,
                "--top-percent",
                newYPercent
            );

            movement.x = e.clientX;
            movement.y = e.clientY;
        });

        function getCustomProperty(element, variable) {
            return getComputedStyle(element).getPropertyValue(variable);
        }

        function setCustomElementProperty(element, variable, value) {
            element.style.setProperty(variable, value);
        }

        // sluggable
        const name = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        name.addEventListener('change', function() {
            fetch(`/regions/create_slug?name=${name.value}`).then(res => res.json()).then(data => slug.value =
                data
                .slug);
        });
    </script>
@endsection

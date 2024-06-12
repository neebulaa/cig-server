@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">Products Page</h1>
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
                        <form class="p-4 border bg-white rounded-lg"
                            onsubmit="changePageContentValue(event, {{ $content['id'] }})">
                            <p class="font-semibold font-sans mb-1 capitalize">{{ $content['title'] }}</p>
                            <div>
                                @foreach ($content['values'] as $index => $value)
                                    <div class="[&:not(:first-child)]:mt-4">
                                        <label for="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}"
                                            class="capitalize block antialiased font-sans leading-normal text-blue-gray-900 mb-2 font-medium">
                                            {{ $value['type'] }}:</label>

                                        @if ($content['type'] == 'text' || $content['type'] == 'button')
                                            <input placeholder="Type something..." type="text"
                                                id="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}"
                                                name="{{ $value['type'] }}_{{ $index + 1 }}"
                                                class="input w-full bg-transparent text-blue-gray-700 font-sans font-normal border focus:border-2 text-sm px-3 py-3 rounded-md border-blue-gray-200 focus:border-gray-900"
                                                value="{{ $value['value'] }}" />
                                        @elseif ($content['type'] == 'filter')
                                            <input type="checkbox"
                                                id="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}"
                                                name="{{ $value['type'] }}_{{ $index + 1 }}"
                                                class="input w-full bg-transparent text-blue-gray-700 font-sans font-normal border focus:border-2 text-sm px-3 py-3 rounded-md border-blue-gray-200 focus:border-gray-900"
                                                value="{{ $value['value'] }}" />
                                        @elseif ($content['type'] == 'textarea')
                                            <textarea cols="30" rows="10" name="{{ $value['type'] }}_{{ $index + 1 }}"
                                                id="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}"
                                                class="input resize-none w-full bg-transparent text-blue-gray-700 font-sans font-normal border focus:border-2 text-sm px-3 py-3 rounded-md border-blue-gray-200 focus:border-gray-900">{{ $value['value'] }}</textarea>
                                        @endif
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
    <script>
        async function changePageContentValue(e, id) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const inputs = e.target.querySelectorAll('.input');
            let body = getJsonFromFormData(formData);
            const response = await fetching('PUT', `/api/page-content/main/${id}`, {
                body: JSON.stringify(body),
            });
            if (response.status == 422) {
                setFormInputErrors('on', e.target, inputs, response.data.errors);
                Toast.open('danger', response.data.message);
            } else if (response.status == 200) {
                setFormInputErrors('off', e.target, inputs, response.data.errors);
                Toast.open('success', response.data.message);
            }
        }
    </script>
@endsection

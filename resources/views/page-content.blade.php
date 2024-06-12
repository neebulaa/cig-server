@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">{{ $title }} Page</h1>
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
                <div class="mt-4 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr))">
                    @foreach ($contents as $content)
                        <form class="p-4 border bg-white rounded-lg"
                            onsubmit="changePageContentValue(event, {{ $content['id'] }})">
                            <p class="font-semibold font-sans mb-1 capitalize">{{ $content['title'] }}</p>
                            <div>
                                @foreach ($content['values'] as $index => $value)
                                    <div class="[&:not(:first-child)]:mt-4">
                                        <div class="input-box">
                                            <label for="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}"
                                                class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white">
                                                {{ $value['name'] }}:</label>

                                            @if ($value['type'] == 'text')
                                                <input placeholder="Type something..." type="text"
                                                    id="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}"
                                                    name="{{ $value['type'] }}_{{ $index + 1 }}"
                                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    value="{{ $value['value'] }}" />
                                            @elseif ($value['type'] == 'table_filters')
                                                @foreach ($content['filters'] as $indexFilter => $filter)
                                                    <div class="flex items-center gap-2">
                                                        <input type="checkbox"
                                                            id="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}-{{ $indexFilter }}"
                                                            value="{{ $filter->slug }}"
                                                            name="{{ $value['type'] }}_{{ $index + 1 }}"
                                                            {{ in_array($filter->slug, explode(',', $value['value'])) ? 'checked' : '' }}>
                                                        <label
                                                            for="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}-{{ $indexFilter }}"
                                                            class="">{{ $filter->name }}</label>
                                                    </div>
                                                @endforeach
                                            @elseif ($value['type'] == 'textarea')
                                                <textarea cols="30" rows="10" name="{{ $value['type'] }}_{{ $index + 1 }}"
                                                    id="{{ $content['page'] }}-{{ $content['key'] }}-{{ $value['type'] }}"
                                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $value['value'] }}</textarea>
                                            @endif
                                        </div>
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
            const inputs = e.target.querySelectorAll('.input-box');
            let body = getJsonFromFormData(formData);
            Object.keys(body).forEach(key => {
                if (key.includes('table_filters')) {
                    body[key] = Array.isArray(body[key]) ? body[key] : [body[key]];
                }
            });
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

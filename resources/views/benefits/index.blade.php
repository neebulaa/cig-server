@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">All Benefits</h1>
    <p class="mt-1">This page is for managing all benefits</p>
    <a href="/benefits/create"
        class="block w-max mt-4 align-middle select-none font-sans font-bold text-center uppercase transition-all text-xs py-2 px-4 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85]">Create
        Benefit</a>
    @if (session()->has('success'))
        <div class="mt-4 mb-4">
            @include('partials.alert', [
                'type' => 'success',
                'message' => session('success'),
            ])
        </div>
    @endif
    <hr class="mt-4 mb-4">
    @include('partials.search', [
        'page' => 'benefits',
    ])
    @if ($benefits->count())
        <div class="relative flex flex-col bg-clip-border rounded-xl bg-white text-gray-700 shadow-md">
            <div class="p-6 overflow-x-scroll px-0 pt-0 pb-2">
                <table class="w-full min-w-[640px] table-auto">
                    <thead>
                        <tr>
                            <th class="border-b border-blue-gray-50 py-3 px-5 text-left">
                                <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                                    Title</p>
                            </th>
                            <th class="border-b border-blue-gray-50 py-3 px-5 text-left">
                                <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                                    Description</p>
                            </th>
                            <th class="border-b border-blue-gray-50 py-3 px-5 text-left">
                                <p class="block antialiased font-sans text-[11px] font-bold uppercase text-blue-gray-400">
                                </p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($benefits as $benefit)
                            <tr>
                                <td class="py-3 px-5 border-b border-blue-gray-50">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $benefit->public_icon }}" alt="image-{{ $benefit->title }}"
                                            class="bg-black inline-block relative object-contain object-center rounded p-1 w-10 h-10">
                                        <p
                                            class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-bold">
                                            {{ $benefit->title }}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-5 border-b border-blue-gray-50 max-w-[600px]">
                                    <p class="block antialiased font-sans text-sm font-medium text-blue-gray-600">
                                        {{ substr($benefit->description, 0, 100) }}
                                        {{ strlen($benefit->description) > 100 ? '...' : '' }}</p>
                                </td>
                                <td
                                    class="py-3 px-5 border-b border-blue-gray-50 text-blue-gray-600 font-sans text-xs font-semibold w-[100px] max-w-full">
                                    <div class="flex gap-4 justify-center items-center">
                                        <a href="/benefits/{{ $benefit->slug }}" class="block">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                fill="currentColor" width="16" height="16">
                                                <path
                                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                            </svg>
                                        </a>
                                        <a href="/benefits/edit/{{ $benefit->slug }}" class="block">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                fill="currentColor" viewBox="0 0 512 512">
                                                <path
                                                    d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                            </svg>
                                        </a>
                                        <button data-modal-target="popup-modal-{{ $benefit->slug }}"
                                            data-modal-toggle="popup-modal-{{ $benefit->slug }}" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14"
                                                height="14" fill="currentColor">
                                                <path
                                                    d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                            </svg>
                                        </button>
                                        <div id="popup-modal-{{ $benefit->slug }}" tabindex="-1"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <form method="post" action="/benefits/{{ $benefit->slug }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button"
                                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="popup-modal-{{ $benefit->slug }}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-4 md:p-5 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            <h3
                                                                class="mb-5 text-lg font-normal text-gray-600 dark:text-gray-400">
                                                                Are you sure you want to delete
                                                                this benefit?</h3>
                                                            <button data-modal-hide="popup-modal-{{ $benefit->slug }}"
                                                                type="submit"
                                                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Yes, I'm sure
                                                            </button>
                                                            <button data-modal-hide="popup-modal-{{ $benefit->slug }}"
                                                                type="button"
                                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                                                cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h3 class="text-lg text-blue-gray-900 font-bold mt-4">Currently there is no benefit
            {{ request('search') ? 'with keyword ' . request('search') : '' }}</h3>
        <p>Please add some data</p>
    @endif

    @if ($benefits->count() && !($benefits->onFirstPage() && $benefits->onLastPage()))
        <div class="mt-4">
            {{ $benefits->links('partials.paginator') }}
        </div>
    @endif
@endsection

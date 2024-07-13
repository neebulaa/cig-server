@extends('layouts.main')
@section('content')
    <h1 class="text-2xl text-blue-gray-900 font-bold mt-4">All Benefits</h1>
    <p class="mt-1">This page is for managing all benefits <span class="text-red-500">(MAX 3 BENEFITS)</span></p>
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
        <p class="mb-2 text-blue-gray-600 text-sm">Benefits found: {{ $total_items }}</p>
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

@extends('layouts.main')

@section('content')
    @if (session()->has('login_error'))
        @include('partials.alert', [
            'type' => 'danger',
            'width' => 'w-full',
            'message' => session('login_error'),
        ])
    @endif
    <form class="mt-6 mb-2 mx-auto max-w-screen-lg" method="post">
        @csrf
        <div class="mb-1 flex flex-col gap-4">
            <div>
                <label for="login-username" class="block mb-2 text-sm font-sans font-medium text-gray-900 dark:text-white">
                    Username</label>
                <input placeholder="Your Username" type="text" id="login-username" name="username"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('username') border-red-500 @enderror"
                    value="{{ old('username', '') }}" />
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="login-password"
                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 mb-1 font-medium">
                    Password</label>
                <input placeholder="Your Password" type="password" id="login-password" name="password"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') border-red-500 @enderror" />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button
            class="align-middle select-none font-sans font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none block w-full mt-6"
            style="position: relative; overflow: hidden;">Login</button>
    </form>
@endsection

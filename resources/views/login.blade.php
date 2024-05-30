@extends('layouts.main')

@section('content')
    @if (session()->has('login_error'))
        @include('partials.alert', [
            'type' => 'danger',
            'message' => session('login_error'),
        ])
    @endif
    <form class="mt-6 mb-2 mx-auto max-w-screen-lg" method="post">
        @csrf
        <div class="mb-1 flex flex-col gap-6">
            <div>
                <label for="login-username"
                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 mb-1 font-medium">
                    Username</label>
                <input placeholder="Your Username" type="text" id="login-username" name="username"
                    class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal border focus:border-2 text-sm px-3 py-3 rounded-md border-blue-gray-200 focus:border-gray-900 @error('username') border-red-500 @enderror"
                    value={{ old('username', '') }} />
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="login-password"
                    class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 mb-1 font-medium">
                    Password</label>
                <input placeholder="Your Password" type="password" id="login-password" name="password"
                    class="peer w-full h-full bg-transparent text-blue-gray-700 font-sans font-normal border focus:border-2 text-sm px-3 py-3 rounded-md border-blue-gray-200 focus:border-gray-900 @error('password') border-red-500 @enderror" />
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

@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <a
            href="{{ route('home') }}"
            class="text-center text-6xl font-bold text-gray-900">
            <h1>Barta</h1>
        </a>

        <h1
            class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Sign in to your account
        </h1>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">

        @session('success')
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
             role="alert">
            <span class="font-medium">Success!</span> {{ session('success') }}
        </div>
        @endsession

        @session('error')
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400"
             role="alert">
            <span class="font-medium">Error!</span> {{ session('error') }}
        </div>
        @endsession

        <form class="space-y-6" action="{{ route('login') }}" method="POST" novalidate>
            @csrf

            <div>
                <label for="email"
                       class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                    <input id="email"
                           name="email"
                           type="email"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           placeholder="bruce@wayne.com"
                           required
                           class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"/>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password"
                           class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="text-sm">
                        <a
                            href="#"
                            class="font-semibold text-black hover:text-black">Forgot password?</a>
                    </div>
                </div>
                <div class="mt-2">
                    <input id="password"
                           name="password"
                           type="password"
                           autocomplete="current-password"
                           placeholder="••••••••"
                           required
                           class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6"/>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
                    Sign in
                </button>
            </div>
        </form>

        <p class="mt-10 text-center text-sm text-gray-500">
            Don't have an account yet?
            <a
                href="{{  route('register') }}"
                class="font-semibold leading-6 text-black hover:text-black">Sign Up</a>
        </p>
    </div>
@endsection

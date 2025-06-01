@extends('layouts.app')

@section('content')
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Sign in to your account
            </h2>
        </div>
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('email') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-t-md focus:outline-none focus:z-10 sm:text-sm"
                        placeholder="Email address"
                        value="{{ old('email') }}"
                        required>
                    @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password"
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border @error('password') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-b-md focus:outline-none focus:z-10 sm:text-sm"
                        placeholder="Password"
                        required>
                    @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
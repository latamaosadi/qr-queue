@extends('layouts.auth')

@section('content')
    <h1 class="text-center text-4xl font-bold">{{ $title }}</h1>
    <form
        action="{{ route($route) }}"
        method="POST"
        class="px-8 pt-6 pb-8"
    >
        @csrf
        <div class="mb-4">
            <label
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                for="username"
            >
                Username
            </label>
            <input
                id="username"
                type="text"
                placeholder="Username"
                name="username"
                value="{{ old('username') }}"
                required
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            >
            @if ($errors->has('username'))
                <p class="text-red-500 text-xs italic" role="alert">
                    {{ $errors->first('username') }}
                </p>
            @endif
        </div>
        <div class="mb-6">
            <label
                for="password"
                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            >
                Password
            </label>
            <input
                id="password"
                type="password"
                placeholder="******************"
                name="password"
                value="{{ old('password') }}"
                required
                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
            >
            @if ($errors->has('password'))
                <p class="text-red-500 text-xs italic" role="alert">
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>
        <div class="mb-6">
            <label class="md:w-2/3 block text-gray-500 font-bold">
                <input
                    id="remember"
                    type="checkbox"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                    class="mr-2 leading-tight"
                >
                <span class="text-sm">
                    Ingat Saya
                </span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <button
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
            >
                Sign In
            </button>
        </div>
    </form>
@endsection
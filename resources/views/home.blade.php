@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/notyf/notyf.min.css') }}">
@endsection

@section('content')

<div class="p-6 flex flex-col">
    <div>
        <h1 class="text-center text-4xl text-gray-800 font-bold">Antrian Pintar BPJAMSOSTEK</h1>
        <p
            id="clock"
            class="text-center font-mono"
        ></p>
    </div>
    <input
        type="text"
        name="qrcode"
        id="scanner-focus"
        class="opacity-0 fixed w-0 h-0 top-0 left-0"
    >
    <div class="flex mt-8 -mx-2">
        @foreach ($counters as $counter)
            <div class="flex-1 px-2">
                <div class="p-6 bg-red-100 text-red-400 border border-red-400 text-center font-mono rounded-lg">
                    <h2 class="text-2xl">Loket <span class="font-bold">{{ $counter->name }}</span></h2>
                    <p class="mt-4 text-lg">
                        @if (isset($counter->customers[0]))
                            {{ $counter->customers[0]->readableQueue }}
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex -mx-2 items-stretch mt-4">
        <div class="px-2 w-2/5 flex">
            <div class="relative p-6 rounded-lg bg-gray-100 text-gray-600 border border-gray-600 flex-1">
                <div class="text-center">
                    <h1 class="text-2xl">Antrian Terakhir</h1>
                    <h2 class="text-4xl font-bold font-mono" id="queue-container">{{ $queue }}</h2>
                </div>
            </div>
        </div>
        <div class="px-2 w-3/5">
            <div
                id="scanner-info"
                class="p-6 rounded-lg bg-gray-700 text-gray-100 border border-gray-600 h-72 text-2xl"
            ></div>
        </div>
    </div>
    <div class="mt-4 p-6 rounded-lg bg-blue-100 text-blue-400 border border-blue-400">
        <h3 class="text-4xl font-bold flex items-center">
            <svg
                fill="currentColor"
                viewBox="0 0 20 20"
                class="w-12 mr-2"
            >
                <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"
                ></path>
            </svg>
            Cara Mendapatkan Nomor Antrian
        </h3>
        <p class="mt-2">
            <ol class="list-decimal ml-6 text-xl">
                <li>Arahkan kartu Anda pada tempat yang sudah ditentukan</li>
                <li>Tunggu sampai Anda mendapatkan nomor antrian, nomor antrian akan dikirimkan ke email Anda</li>
                <li>Setelah mendapatkan nomor antrian, silahkan tunggu untuk dipanggil di tempat yang sudah disediakan.</li>
            </ol>
        </p>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('vendor/onscan/onscan.min.js') }}"></script>
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
    <script src="{{ asset('js/scanner.js') }}"></script>
@endsection
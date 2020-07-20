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
                    <p class="mt-4 text-lg" id="monitor-counter-{{ $counter->id }}">
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
            <div class="relative p-6 rounded-lg bg-gray-100 text-gray-600 border border-gray-600 flex-1 text-center">
                <div class="">
                    <h3 class="text-2xl">No. Antrian Terakhir</h3>
                    <p class="text-4xl font-bold font-mono" id="queue-container">{{ $queue }}</p>
                </div>
                <div class="mt-2">
                    <h3 class="text-2xl">Jumlah Antrian Menunggu</h3>
                    <p class="text-4xl font-bold font-mono" id="inline-count">{{ $inlineCount }}</p>
                </div>
                <div class="mt-2">
                    <h3 class="text-2xl">No. Antrian Sedang diproses</h3>
                    <p class="text-4xl font-bold font-mono" id="current-queue">{{ $currentQueue }}</p>
                </div>
            </div>
        </div>
        <div class="px-2 w-3/5">
            <div
                id="scanner-info"
                class="p-6 rounded-lg bg-gray-700 text-gray-300 border border-gray-600 h-96 text-2xl"
            >
            </div>
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

<div id="scanner-placeholder" class="hidden">
    <div class="h-full w-full flex items-center justify-center">
        <div class="m-auto">
            <svg fill="currentColor" viewBox="0 0 20 20" class="w-20 mx-auto"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2v1h1V5h-1z" clip-rule="evenodd"></path><path d="M11 4a1 1 0 10-2 0v1a1 1 0 002 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z"></path></svg>
            <p class="mt-2 text-2xl">Scan Kartu Anda</p>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('vendor/onscan/onscan.min.js') }}"></script>
    <script src="{{ asset('vendor/notyf/notyf.min.js') }}"></script>
    <script src="{{ asset('js/scanner.js') }}"></script>
@endsection
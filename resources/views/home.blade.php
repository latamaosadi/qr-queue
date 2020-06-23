@extends('layouts.app')

@section('content')

<div class="h-screen p-6 flex flex-col">
    <div>
        <h1 class="text-center text-4xl text-center text-gray-800 font-bold">Antrian Pintar BPJAMSOSTEK</h1>
        <p
            id="clock"
            class="text-center"
        ></p>
    </div>
    <div class="flex-1">
        <div class="flex h-full">
            <div class="flex-1 p-6 flex flex-col">
                <div class="p-6 rounded-lg bg-gray-200 flex-1">
                    <h1 class="text-2xl font-bold">Antrian Terakhir</h1>
                    <h2 class="text-4xl font-bold" id="queue-container">{{ $queue }}</h2>
                </div>
            </div>
            <div class="w-1/3">
                <video
                    id="preview"
                    class="h-full w-full"
                >
                </video>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ asset('vendor/instascan/instascan.min.js') }}"></script>
    <script src="{{ asset('js/scanner.js') }}"></script>
@endsection
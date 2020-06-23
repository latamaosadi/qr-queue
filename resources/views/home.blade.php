@extends('layouts.app')

@section('content')

<div class="h-screen relative">
    <div class="absolute inset-0">
        <h1 class="text-white text-2xl font-bold text-center">Queue Scanner</h1>
        <h2 class="text-white text-4xl font-bold text-center" id="queue-container"></h2>
    </div>
    <video
        id="preview"
        class="h-full w-full"
    >
    </video>
</div>

@endsection

@section('script')
    <script src="{{ asset('vendor/instascan/instascan.min.js') }}"></script>
    <script src="{{ asset('js/scanner.js') }}"></script>
@endsection
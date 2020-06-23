@extends('layouts.app')

@section('content')

<div class="h-screen relative">
    <div class="absolute">
        <h1 class="text-white text-2xl font-bold">Queue Scanner</h1>
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
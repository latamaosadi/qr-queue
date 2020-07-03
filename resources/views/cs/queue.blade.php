@extends('layouts.cs')

@section('content')
    <div class="p-6">
        <queue :counter="{{ Auth::user()->counter->id }}"></queue>
    </div>
@endsection
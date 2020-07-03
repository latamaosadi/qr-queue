@extends('layouts.cs')

@section('content')
    <queue :counter="{{ Auth::user()->counter->id }}"></queue>
@endsection
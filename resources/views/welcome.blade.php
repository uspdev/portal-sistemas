@extends('layouts.app')

@section('content')

    @foreach ($sistemas as $sistema)

        <div>
            <a href="{{ $sistema->url }}">{{ $sistema->nome }}</a>
        </div>

    @endforeach

@endsection

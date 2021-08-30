@extends('layouts.app')

@section('content')

    @foreach ($sistemas as $sistema)

        <div>
            <a href="{{ $sistema->url }}">{{ $sistema->nome }}</a> {{ $sistema->grupos[0]->nome }}
        </div>

    @endforeach

@endsection

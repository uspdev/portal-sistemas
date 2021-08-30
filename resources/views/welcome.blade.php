@extends('layouts.app')

@section('content')

<div class="row">
    @foreach ([1,2,3] as $col)
    <div class="col-md-4">
        @foreach ($grupos->where('coluna', $col) as $grupo)
        <div class="h3">{{ $grupo->nome }}</div>
        <div class="ml-3">
            @foreach ($grupo->sistemas as $sistema)
            <div>
                @if($sistema->url)
                <a href="{{ $sistema->url }}">{{ $sistema->nome }}</a>
                @else
                {{ $sistema->nome }}
                @endif
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    @endforeach
</div>

@endsection
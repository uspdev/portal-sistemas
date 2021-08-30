@extends('layouts.app')

@section('content')

  <div class="row">
    @foreach ([1, 2, 3] as $col)
      <div class="col-md-4">
        @foreach ($grupos->where('coluna', $col) as $grupo)
          <div class="card mb-3">
            <div class="card-header h4">
              {{ $grupo->nome }}
            </div>
            <div class="card-body">
              @foreach ($grupo->sistemas as $sistema)
                @include('partials.sistema')
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>

@endsection

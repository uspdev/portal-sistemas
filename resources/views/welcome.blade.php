@extends('layouts.app')

@section('content')

  <div class="row">
    @foreach (range(1,config('portal-sistemas.num_cols')) as $col)
      <div class="col-md-{{ config('portal-sistemas.col_width') }}">
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
  <hr>
  <div class="row">
    @foreach (range(config('portal-sistemas.num_cols')+1, 4) as $col)
      <div class="col-md-{{ config('portal-sistemas.col_width') }}">
        @foreach ($grupos->where('coluna', $col) as $grupo)
          <div class="card mb-3">
            <div class="card-header">
              <span class="h4 align-middle">{{ $grupo->nome }}</span> 
              @can('admin')<span class="badge badge-danger ml-2">Grupo sem coluna</span>@endcan
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

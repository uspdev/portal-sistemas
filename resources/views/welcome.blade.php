@extends('layouts.app')

@section('content')

  <div class="row">
    @foreach (range(1, config('portal-sistemas.num_cols')) as $col)
      <div class="col-md-{{ config('portal-sistemas.col_width') }}">
        @include('partials.grupos-coluna')
      </div>
    @endforeach
  </div>

  <div class="row">
    @foreach (range(config('portal-sistemas.num_cols') + 1, 4) as $col)
      <div class="col-md-12">
        @include('partials.grupos-coluna')
      </div>
    @endforeach
  </div>

@endsection

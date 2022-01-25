@extends('layouts.app')

@section('content')
  <div class="alert alert-danger mt-2" role="alert">
    <div class="h4">Erro 404!</div>
    A página que você acessou não foi encontrada.
  </div>

  <livewire:show-grupos />
@endsection

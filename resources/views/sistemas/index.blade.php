@extends('layouts.app')

@section('content')
  <table class="table table-bordered table-sm table-hover datatable">
    <thead>
      <th>Nome</th>
      <th>URL</th>
      <th>Descrição</th>
      <th>Grupos</th>
    </thead>
    @forelse($sistemas as $sistema)
      <tr>
        <td><a href="{{ route('sistemas.show', $sistema) }}">{{ $sistema->nome }}</a></td>
        <td>{{ $sistema->url }} <a href="{{ $sistema->url }}" target="_BLANK"><i class="fas fa-external-link-alt"></i></a></td>
        <td>{{ $sistema->descricao }}</td>
        <td>{{ implode(',', $sistema->grupos->pluck('nome')->toArray()) }}</td>
      </tr>
    @empty
    @endforelse
  </table>
@endsection

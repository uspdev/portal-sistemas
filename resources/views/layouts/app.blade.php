@extends('laravel-usp-theme::master')

@section('menu')
  @can('gerente')
    @parent
  @endcan
@endsection

@section('styles')
  @parent
  @livewireStyles
  <style>
    
    /* mostra to-show ao passar o mouse sobre to-hover */
    .to-show {
      display: none;
    }

    .to-hover:hover>.to-show {
      display: inline-block;
    }

    /* https://stackoverflow.com/questions/28678542/how-to-change-bootstraps-global-default-font-size */
    html {
      font-size: {{ config('portal-sistemas.base_font_size') }}px;
    }

  </style>
@endsection

@section('footer')
  Seu código
@endsection

@section('javascripts_bottom')
  @parent
  @livewireScripts
  <script>
    // Seu código .js
  </script>
@endsection

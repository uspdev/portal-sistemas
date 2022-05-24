@extends('laravel-usp-theme::master')

@section('menu')
  @can('user')
    @parent
  @endcan
@endsection

@section('skin_login_bar')
  @if (Gate::allows('user'))
    @parent
  @else
    @if (config('portal-sistemas.login_bar'))
      @parent
    @else
      <div class="py-2"></div>
    @endif
  @endif

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

    .hover-bg:hover {
      background-color: lightgray;
    }

    /* https://stackoverflow.com/questions/28678542/how-to-change-bootstraps-global-default-font-size */
    html {
      font-size: {{ config('portal-sistemas.base_font_size') }}px;
    }

  </style>
@endsection

@section('javascripts_bottom')
  @parent
  @livewireScripts
@endsection

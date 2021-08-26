@extends('laravel-usp-theme::master')

@section('title') Sistema USP @endsection

@section('menu')
    @can('admin')
        @parent
    @endcan
@endsection

@section('styles')
    @parent
    <style>
        /*seus estilos*/

    </style>
@endsection

@section('footer')
    Seu código
@endsection

@section('javascripts_bottom')
    @parent
    <script>
        // Seu código .js
    </script>
@endsection

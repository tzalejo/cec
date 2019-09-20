@extends('errors::illustrated-layout')

@section('code', '404')
@section('title', __('Página no encontrada'))
@section('image')
<div style="background-image: url('{{asset('img/404.jpeg')}}');background-size: contain; width: inherit; height: inherit;" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection 
@section('message', __('No hemos encontrado la página que buscas.'))
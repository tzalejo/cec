@extends('errors::illustrated-layout')

@section('code', '419')
@section('title', __('Session Expirada.'))
@section('image')
<div style="background-image: url('{{asset('img/500.png')}}');background-size: contain; width: inherit; height: inherit;" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection 
@section('message', __('Lo sentimos, tu sesión ha expirado. Por favor, actualice y pruebe de nuevo.'))
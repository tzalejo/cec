@extends('errors::illustrated-layout')

@section('code', '500')
@section('title', __('Error del Servidor'))
@section('image')
<div style="background-image: url('{{asset('img/500.png')}}');background-size: contain; width: inherit; height: inherit;" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection 
@section('message', __('Error Interno del Servidor.'))
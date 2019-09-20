@extends('errors::illustrated-layout')

@section('code', '403')
@section('title', __('Acceso denegado'))

@section('image')
<div style="background-image: url('{{asset('img/403.png')}}');background-size: contain; width: inherit; height: inherit;" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection 

@section('message', __('No tiene autorizacion para ver esta página.'))


@extends('errors::illustrated-layout')

@section('code', '401')
@section('title', __('Sin Autorización'))
@section('image')
<div style="background-image: url('{{asset('img/401.jpg')}}');background-size: contain; width: inherit; height: inherit;" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection 
@section('message', __('Ha fallado la autentificación.'))
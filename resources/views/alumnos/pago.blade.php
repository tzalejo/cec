@extends('layouts.app')
@section('content')
<h1>PAGO</h1>
<h4>Alumno</h4>

<div class="form-row">
  <div class="form-group col-md-6">
    <input type="text" class="form-control" id="estudianteApellido" placeholder="Apellido" name="estudianteApellido" value="{{$cuota->matricula->estudiante->estudianteApellido}}" disabled>
  </div>
  <div class="form-group col-md-6">
    <input type="text" class="form-control" id="estudianteNombre" placeholder="Nombre" name="estudianteNombre" value="{{$cuota->matricula->estudiante->estudianteNombre}}" disabled>
  </div>
  <div class="form-group col-md-3">
    <input type="text" class="form-control" id="estudianteDNI" placeholder="DNI" name="estudianteDNI" value="{{$cuota->matricula->estudiante->estudianteDNI}}" disabled>
  </div>
  <div class="form-group col-md-9">
    <input type="email" class="form-control" id="estudianteEmail" placeholder="Email" name="estudianteEmail" value="{{$cuota->matricula->estudiante->estudianteEmail}}" disabled>
  </div>
  <div class="form-group col-md-6">
    <input type="text" class="form-control" id="cursoNombre" name="cursoNombre" value="{{$cuota->matricula->comision->curso->cursoNombre}} - {{$cuota->matricula->comision->comisionNombre}}" disabled>
  </div>
  <div class="form-group col-md-6">
    <input type="text" class="form-control" id="cuotaConcepto" name="cuotaConcepto" value="{{$cuota->cuotaConcepto}}" disabled>
  </div>
  
</div>

<form method="POST" action="{{route('alumnos.cancelarPago',['cuota'=>$cuota])}}">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-8">
      <label class="sr-only" for="cuotaMonto">0.00</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">$</div>
        </div>
        <input type="number" class="form-control" name="cuotaMonto" id="cuotaMonto" autofocus  placeholder="0.00" data-decimals="2">
      </div>
    </div>
    <div class="form-group col-md-4">
      <input type="text" class="form-control" value="$ {{$cuota->cuotaFaltante()}}" disabled>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Pagar</button>
      <a href="{{route('home')}}" class="btn btn-primary">Cancelar</a>

    </div>
  </div>
</form>


@endsection
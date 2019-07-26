@extends('layouts.app')
@section('content')
<h1>Inscripcion</h1>
<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputNombre">Nombre</label>
      <input type="text" class="form-control" id="inputNombre" placeholder="Nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="inputApellido">Apellido</label>
      <input type="text" class="form-control" id="inputApellido" placeholder="Apellido">
    </div>
    <div class="form-group col-md-3">
      <label for="inputDni">DNI</label>
      <input type="number" class="form-control" id="inputDni" placeholder="DNI">
    </div>
  
    <div class="form-group col-md-9">
      <label for="inputDomicilio">Domicilio</label>
      <input type="text" class="form-control" id="inputDomicilio" placeholder="Sargento Cabral 32">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputLocalidad">Localidad</label>
      <input type="text" class="form-control" id="inputLocalidad">
    </div>
    <div class="form-group col-md-3">
      <label for="inputFoto">Foto</label>
      <input type="file" class="form-control-file" id="exampleFormControlFile1">
    </div>
    <div class="form-group col-md-9">
      <label for="inputEmail">Email</label>
      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
    </div>
    <div class="form-group col-md-3">
      <label for="inputTelefono">Telefono</label>
      <input type="text" class="form-control" id="inputTelefono" placeholder="Telefono">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputCurso">Curso</label>
      <select class="form-control" id="inputCurso">
        @forelse ($comisionesAbiertas as $comision)
          <option>{{$comision->comisionNombre}} - {{$comision->comisionHorario}} - Alumnos({{$comision->cantidadAlumnos()}})</option>
        @empty
          <option>Sin Comisiones</option>
        @endforelse
        
      </select>
    </div>
  </div>
  <a href="#" class="btn btn-primary">Inscribir</a>
  <a href="#" class="btn btn-primary">Cancelar</a>
  {{-- <button type="submit" class="btn btn-primary">Cancelar</button> --}}
</form>
@endsection
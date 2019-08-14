@extends('layouts.app')
@section('content')
  <h1>Inscripcion</h1>
  <form method="POST" action="{{route('alumnos.crear')}}">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="estudianteNombre">Nombre</label>
        <input type="text" autofocus  class="form-control @error('estudianteNombre') is-invalid @enderror" id="estudianteNombre" placeholder="Nombre" name="estudianteNombre" value="{{old('estudianteNombre')}}">
        @error('estudianteNombre')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group col-md-6">
        <label for="estudianteApellido">Apellido</label>
        <input type="text" class="form-control @error('estudianteApellido') is-invalid @enderror" id="estudianteApellido" placeholder="Apellido" name="estudianteApellido" value="{{old('estudianteApellido')}}">
        @error('estudianteApellido')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group col-md-3">
        <label for="estudianteDNI">DNI</label>
        <input type="text" class="form-control @error('estudianteDNI') is-invalid @enderror" id="estudianteDNI" placeholder="DNI" name="estudianteDNI" value="{{old('estudianteDNI')}}">
        @error('estudianteDNI')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    
      <div class="form-group col-md-9">
        <label for="estudianteDomicilio">Domicilio</label>
        <input type="text" class="form-control @error('estudianteDomicilio') is-invalid @enderror" id="estudianteDomicilio" placeholder="Sargento Cabral 32" name="estudianteDomicilio" value="{{old('estudianteDomicilio')}}">
        @error('estudianteDomicilio')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-5">
        <label for="estudianteLocalidad">Localidad</label>
        <input type="text" class="form-control @error('estudianteLocalidad') is-invalid @enderror" id="estudianteLocalidad" name="estudianteLocalidad" value="{{old('estudianteLocalidad')}}">
        @error('estudianteLocalidad')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group col-md-4" style="margin-bottom:5px; margin-top:31px;">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="estudianteFoto" name="estudianteFoto">
          <label class="custom-file-label" for="estudianteFoto">Choose file...</label>
        </div>
      </div>
      <div lass="form-group col-md-3" style="margin-bottom: 0px; margin-top: -1px; padding: 0px 5px;">
        <label for="estudianteNacimiento">Nacimiento</label>
        <input class="form-control @error('estudianteNacimiento') is-invalid @enderror" type="date"  id="estudianteNacimiento" name="estudianteNacimiento" value="{{old('estudianteNacimiento')}}">  
        @error('estudianteNacimiento')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group col-md-9">
        <label for="estudianteEmail">Email</label>
        <input type="email" class="form-control @error('estudianteEmail') is-invalid @enderror" id="estudianteEmail" placeholder="Email" name="estudianteEmail" value="{{old('estudianteEmail')}}">
        @error('estudianteEmail')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group col-md-3">
        <label for="estudianteTelefono">Telefono</label>
        <input type="text" class="form-control" id="estudianteTelefono" placeholder="Telefono" name="estudianteTelefono" value="{{old('estudianteTelefono')}}"> 
        
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
        <label for="comisionId">Curso</label>
        <select class="form-control @error('comisionId') is-invalid @enderror" id="comisionId" name="comisionId">
          @forelse ($comisionesAbiertas as $comision)
            <option value="{{$comision->comisionId}}" >{{$comision->comisionNombre}} - {{$comision->comisionHorario}} - Alumnos({{$comision->cantidadAlumnos()}})</option>
          @empty
            <option>Sin Comisiones</option>
          @endforelse
          @error('comisionId')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </select>
      </div>
    </div>
    <div class="from-row">
      <h2>Pagos</h2>
      <div class="form-group col-md-12">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="pagoInscripcion" name="pagoInscripcion">
          <label class="custom-control-label" for="pagoInscripcion">Inscripcion</label>
        </div>
        
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="pagoCuota" name="pagoCuota">
          <label class="custom-control-label" for="pagoCuota">Cuota</label>
        </div>

      </div>

    </div>

    {{-- <a href="{{route('alumnos.crear')}}" class="btn btn-primary">Inscribir</a> --}}
    <button type="submit" class="btn btn-primary">Inscribir Alumno</button>
    <a href="{{route('home')}}" class="btn btn-primary">Cancelar</a>
    {{-- <button type="submit" class="btn btn-primary">Cancelar</button> --}}
  </form>
@endsection
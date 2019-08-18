@extends('layouts.app')
@section('content')

<div class="jumbotrom">
  <!-- Content Row -->
  <div class="row">
    <div class="col-xl-12">
      <!-- Overflow Hidden inscripcion-->
      <div class="card shadow mb-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Re - INSCRIPCION</h6>
          <p class="mb-4">Las planillas de inscripciones.</p>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('alumnos.altaReinscripcionEstudiante',[$estudiante])}}">
            @csrf
            <div class="form-row">  
              <div class="form-group col-md-6">
                <label for="estudianteNombre">Nombre</label>
                <input disabled type="text"  class="form-control" id="estudianteNombre" placeholder="Nombre" name="estudianteNombre" value="{{$estudiante->estudianteNombre}}">
              </div>
              <div class="form-group col-md-6">
                <label for="estudianteApellido">Apellido</label>
                <input disabled type="text" class="form-control" id="estudianteApellido" placeholder="Apellido" name="estudianteApellido" value="{{$estudiante->estudianteApellido}}">
              </div>
              <div class="form-group col-md-3">
                <label for="estudianteDNI">DNI</label>
                <input disabled type="text" class="form-control" id="estudianteDNI" placeholder="DNI" name="estudianteDNI" value="{{$estudiante->estudianteDNI}}">
              </div>
            
              <div class="form-group col-md-9">
                <label for="estudianteDomicilio">Domicilio</label>
                <input disabled type="text" class="form-control" id="estudianteDomicilio" placeholder="Sargento Cabral 32" name="estudianteDomicilio" value="{{$estudiante->estudianteDomicilio}}">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-5">
                <label for="estudianteLocalidad">Localidad</label>
                <input disabled type="text" class="form-control" id="estudianteLocalidad" name="estudianteLocalidad" value="{{$estudiante->estudianteLocalidad}}">
              </div>
              <div class="form-group col-md-4" style="margin-bottom:5px; margin-top:31px;">
                <div class="custom-file">
                  <input disabled type="file" class="custom-file-input" id="estudianteFoto" name="estudianteFoto">
                  <label class="custom-file-label" for="estudianteFoto">Choose file...</label>
                </div>
              </div>
              <div lass="form-group col-md-3" style="margin-bottom: 0px; margin-top: -1px; padding: 0px 5px;">
                <label for="estudianteNacimiento">Nacimiento</label>
                <input disabled class="form-control" type="date"  id="estudianteNacimiento" name="estudianteNacimiento" value="{{$estudiante->estudianteNacimiento}}">  
              </div>
              <div class="form-group col-md-9">
                <label for="estudianteEmail">Email</label>
                <input disabled type="email" class="form-control" id="estudianteEmail" placeholder="Email" name="estudianteEmail" value="{{$estudiante->estudianteEmail}}">
              </div>
              <div class="form-group col-md-3">
                <label for="estudianteTelefono">Telefono</label>
                <input disabled type="text" class="form-control" id="estudianteTelefono" placeholder="Telefono" name="estudianteTelefono" value="{{$estudiante->estudianteTelefono}}"> 
                
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="comisionId">Curso</label>
                <select class="form-control" id="comisionId" name="comisionId">
                  @forelse ($comisionesActivas as $comision)
                    <option value="{{$comision->comisionId}}" > {{$comision->curso->cursoNombre }} - {{ $comision->comisionNombre}} ( {{$comision->comisionHorario}} ) - Alumnos({{$comision->cantidadAlumnos()}})</option>
                  @empty
                    <option>Sin Comisiones</option>
                  @endforelse
                </select>
              </div>
            </div>
            <div class="from-row">
              <h2>Pagos</h2>
              <div class="form-group col-md-12">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" checked id="pagoInscripcion" name="pagoInscripcion" disabled>
                  <label class="custom-control-label" for="pagoInscripcion">Inscripcion</label>
                </div>
                
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="pagoCuota" name="pagoCuota">
                  <label class="custom-control-label" for="pagoCuota">Cuota</label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Inscribir Alumno</button>
            <a href="{{route('home')}}" class="btn btn-primary">Cancelar</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
    
@endsection
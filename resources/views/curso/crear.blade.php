@extends('layouts.app')
@section('content')

<div class="jumbotrom">
  <div class="row">
    <div class="col-xl-12">
      <!-- Overflow Hidden inscripcion-->
      <div class="card shadow mb-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">CURSO</h6>
          <p class="mb-4">Las planillas de creacion de Curso.</p>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('curso.guardar')}}">
            @csrf
            <div class="form-row">  
              <div class="form-group col-md-6">
                <label for="cursoNombre">Nombre Curso</label>
                <input type="text" autofocus  class="form-control @error('cursoNombre') is-invalid @enderror" id="cursoNombre" placeholder="Nombre del Curso" name="cursoNombre" value="{{old('cursoNombre')}}">
                @error('cursoNombre')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="cursoNroCuota">Cantidad Cuota(Meses)</label>
                <input type="number" class="form-control @error('cursoNroCuota') is-invalid @enderror" id="cursoNroCuota" placeholder="00.0" name="cursoNroCuota" value="{{old('cursoNroCuota')}}">
                @error('cursoNroCuota')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label for="cursoCostoMes">Costo</label>
                <input type="number" class="form-control @error('cursoCostoMes') is-invalid @enderror" id="cursoCostoMes" placeholder="$ 0.00" name="cursoCostoMes" value="{{old('cursoCostoMes')}}">
                @error('cursoCostoMes')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            
              <div class="form-group col-md-9">
                <label for="cursoInscripcion">Costo Inscripcion</label>
                <input type="number" class="form-control @error('cursoInscripcion') is-invalid @enderror" id="cursoInscripcion" placeholder="$ 0.00" name="cursoInscripcion" value="{{old('cursoInscripcion')}}">
                @error('cursoInscripcion')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="form-row"> 
              <div class="form-group col-md-12">
                <div class="table-responsive-lg table-wrapper-scroll-y my-custom-scrollbar">
                  <table class="table table-sm table-hover" id="example">
                      <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><a>Materia <i class="icon-sort"></i></a></th>
                            <th scope="col">Seleccion</th>
                        </tr>
                      </thead>
                      <tbody>
                        {{-- llamo a _row.blade.php --}}
                        @each('curso._row', $materias, 'materia')
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Crear Curso</button>
            <a href="{{route('home')}}" class="btn btn-primary">Cancelar</a>
          </form>
          {{-- 
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
                @forelse ($comisionesActivas as $comision)
                  <option value="{{$comision->comisionId}}" >{{$comision->curso->cursoNombre }} - {{ $comision->comisionNombre}} ( {{$comision->comisionHorario}} ) - Alumnos({{$comision->cantidadAlumnos()}}) </option>
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
                <input type="checkbox" class="custom-control-input" checked id="pagoInscripcion" name="pagoInscripcion">
                <label class="custom-control-label" for="pagoInscripcion">Inscripcion</label>
              </div>
              
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="pagoCuota" name="pagoCuota">
                <label class="custom-control-label" for="pagoCuota">Cuota</label>
              </div>
            </div>
          </div> 
          --}}
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
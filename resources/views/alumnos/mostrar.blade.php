@extends('layouts.app')
@section('content')
<div class="container">
  
  <h1>ESTUDIANTES</h1>
  <div class="row">
    <div class="col-sm-4 pull-right">
      <div class="panel-body">{{-- Buscadro de alumnos --}}

        {{ Form::open(['route'=> 'alumnos.mostrar', 'method' => 'GET' , 'class' => 'input-group mb-3', 'role' => 'search']) }}
          {{ Form::text('estudianteApellido', null, ['class' => 'form-control', 'placeholder' => 'Buscar por Apellido..', 'value' => 'estudianteApellido'])  }}
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i> </button>
          </div>
        {{ Form::close() }}
      </div> {{-- fin del buscador --}} 
    </div>
    <div class="col-md-12">
      <table id="example" class="table table-hover table-striped table-responsive-md " >
        <thead>
          <tr class="p-3 mb-2 bg-dark text-white">
            <th scope="col">Codigo</th>
            <th scope="col">DNI</th>
            <th scope="col">Apellido</th>
            <th scope="col">Nombre</th>
            <th class="d-none d-md-table-cell" scope="col">Email</th>
            <th class="d-none d-lg-table-cell" scope="col">Telefono</th>
            <th class="d-none d-xl-table-cell" scope="col">Localidad</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($estudiantes as $estudiante)
          <tr>
            <a href="#">
              <td class="sorting_1">{{$estudiante->estudianteId}}</td>
              <td>{{$estudiante->estudianteDNI}}</td>
              <td>{{$estudiante->estudianteApellido}}</td>
              <td>{{$estudiante->estudianteNombre}}</td>
              <td class="d-none d-md-table-cell" >{{$estudiante->estudianteEmail}}</td>
              <td class="d-none d-lg-table-cell" >{{$estudiante->estudianteTelefono}}</td>
              <td class="d-none d-xl-table-cell" >{{$estudiante->estudianteLocalidad}}</td>
              {{-- <td><a href="" >Pagar</a></td> --}}
              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$estudiante->estudianteId}}">
                  Pagar
                </button>
                <!-- Modal para selecionar la matricula del estudiante( puede tener varias matriculas-curso-) seleccionado -->
                <div class="modal fade" id="exampleModal{{$estudiante->estudianteId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccionar Curso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      {{-- <div class="modal-body"> --}}
                        <table>
                          <thead>
                            <tr>
                              <th scope="col">Matricula</th>
                              <th scope="col">Curso</th>
                              <th scope="col">Comision</th>
                              <th scope="col">Fecha Inicio</th>
                              <th scope="col">Cuota</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            @foreach ($estudiante->matriculas as $matricula)
                              {{-- muestro si y solo si es matricula regular, RE --}}
                              @if ($matricula->esMatriculaRegular())
                                <tr>
                                  <td scope="row">{{$matricula->matriculaId}}</td>
                                  <td>{{$matricula->comision->curso->cursoNombre}}</td>
                                  <td>{{$matricula->comision->comisionNombre}}</td>
                                  <td>{{$matricula->comision->comisionFI}}</td>
                                  <td><a href="{{route('alumnos.cuotas',['matricula'=>$matricula->matriculaId])}}">Ir</a></td>
                                </tr>                          
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                      {{-- </div> --}}
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Cuota</button> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </a>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-sm-12 col-md-5">
      <div class="dataTables_info" id="example_info" role="status" aria-live="polite">
        Mostrando {{$estudiantes->firstItem()}} a {{$estudiantes->lastItem() }} de {{$estudiantes->total()}}  Estudiantes
      </div>
    </div>
    <div class="col-sm-12 col-md-7">
      <div class="d-flex flex-row-reverse bd-highlight">
        {{$estudiantes->render()}}
      </div>
    </div>
    
    </div>  
    
</div>
@endsection
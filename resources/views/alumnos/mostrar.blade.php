@extends('layouts.app')
@section('content')
<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">ESTUDIANTES</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
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
          <div class="col-sm-12">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
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
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal{{$estudiante->estudianteId}}">
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
                                <table class="table table-borderless ">
                                  <thead>
                                    <tr class="table-active">
                                      {{-- <th>Matricula</th>
                                      <th>Curso</th>
                                      <th>Comision</th>
                                      <th>Fecha Inicio</th>
                                      <th>Cuota</th> --}}
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($estudiante->matriculas as $matricula)
                                      {{-- muestro si y solo si es matricula regular, RE --}}
                                      @if ($matricula->esMatriculaRegular())
                                        <tr>
                                          <td>{{$matricula->comision->curso->cursoNombre}}</td>
                                          <td>{{$matricula->comision->comisionNombre}}</td>
                                          <td>{{$matricula->comision->comisionFI}}</td>
                                          <td>{{$matricula->comision->comisionFF}}</td>
                                          <td>
                                            <a class="btn btn-outline-primary" 
                                            @if ($matricula->matriculaCancelada())  style="cursor: default; pointer-events: none;" onclick="return false;" @endif
                                            href="{{route('alumnos.cuotas',['matricula'=>$matricula->matriculaId])}}">
                                              @if ($matricula->matriculaCancelada()) Cancelada   @else Abonar   @endif
                                            </a>
                                          </td>
                                        </tr>                          
                                      @endif
                                    @endforeach
                                  </tbody>
                                </table>
                              {{-- </div> --}}
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
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
        </div>
        <div class="row">
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
    </div>
  </div>
</div> 
@endsection
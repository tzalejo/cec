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
          <div class="col-sm-12">
            <div class="panel-body">{{-- Buscadro de alumnos (apellido o dni)--}}
              {{ Form::open(['route'=> 'alumnos.reinscripcion', 'method' => 'GET' , 'class' => 'input-group', 'role' => 'search']) }}
                <div class="form-group col-md-12 d-flex justify-content-between align-items-end p-0" >
                  {{ Form::text('estudianteApellido', null, ['class' => 'form-control', 'placeholder' => 'Buscar por Apellido..', 'value' => 'estudianteApellido'])  }}
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary " type="submit"><i class="fa fa-search"></i> </button>
                  </div>

                </div>
                <div class="form-group col-md-12 d-flex justify-content-between align-items-end p-0">
                  {{ Form::text('estudianteDNI', null, ['class' => 'form-control', 'placeholder' => 'Buscar por DNI..', 'value' => 'estudianteDNI'])  }}
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i> </button>
                  </div>
                </div>
              {{ Form::close() }}
            </div> {{-- fin del buscador --}} 
          </div>
          <div class="col-sm-12">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
              <thead class="thead-dark">
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
                    
                    <td class="sorting_1">{{$estudiante->estudianteId}}</td>
                    <td>{{$estudiante->estudianteDNI}}</td>
                    <td>{{$estudiante->estudianteApellido}}</td>
                    <td>{{$estudiante->estudianteNombre}}</td>
                    <td class="d-none d-md-table-cell" >{{$estudiante->estudianteEmail}}</td>
                    <td class="d-none d-lg-table-cell" >{{$estudiante->estudianteTelefono}}</td>
                    <td class="d-none d-xl-table-cell" >{{$estudiante->estudianteLocalidad}}</td>
                    {{-- <td><a href="" >Pagar</a></td> --}}
                    <td>
                      <a class="btn btn-outline-primary" href="{{route('alumnos.reinscripcionEstudiante',[$estudiante])}}">
                        Seleccionar
                      </a>
                    </td>
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
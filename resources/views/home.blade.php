@extends('layouts.app')

@section('content')

<div class="jumbotrom">
    <div class="row">
      <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-1">
          <div class="card-header flex-row align-items-center justify-content-between">
            <div class="text-center">
              <h1 class="h4">SISTEMA DE GESTION - CEC</h1>
              <p class="mb-4">Este software esta destinado para la administración del instituto CEC</p>
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>

{{-- detalle de las comisiones abiertas  --}}

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">COMISIONES</h6>
    <p class="mb-4">Descripcion de las comisiones abiertas con la cantidad de alumnos.</p>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table  class="table table-striped"  id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            {{-- <th scope="col">#</th> --}}
            <th scope="col">Curso</th>
            <th scope="col">Comision</th>
            <th scope="col">Horario</th>
            <th scope="col">Inicio</th>
            <th scope="col">Alumnos</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($comisiones as $comision)
            <tr>
              {{-- <th scope="row">1</th> --}}
              <td>{{$comision->curso->cursoNombre}}</td>
              <td>{{$comision->comisionNombre}}</td>
              <td>{{$comision->comisionHorario}}</td>
              <td>{{$comision->comisionFI}}</td>
              <td>{{$comision->cantidadAlumnos()}}</td>
            </tr>
          @empty
            <td>Sin Comisiones</td>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- carteles de comentario --}}
<div class="jumbotrom">
  <div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Seminario</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Desarrollo Web</div>
            </div>
            <div class="col-auto align-items-center">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
              <div class="h6 mb-0 font-weight-bold text-gray-800">1-12-19</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-6 col-md-6 mb-4 ">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Seminario</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Derecho penal</div>
            </div>
            <div class="col-auto align-items-center">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
              <div class="h6 mb-0 font-weight-bold text-gray-800">1-12-19</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <!-- Collapsable Card Example -->
      <div class="card shadow mb-12">
        <!-- Card Header - Accordion -->
        @foreach ($comisiones as $comision)
        <a href="#collapseCardExample{{$comision->comisionId}}" 
          class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" 
          aria-controls="collapseCardExample{{$comision->comisionId}}" style="text-decoration:none;">
          <i class="fa fa-ellipsis-v fa-2x p-3 mr-2 float-left" aria-hidden="true"></i>
          <h4>{{$comision->comisionNombre}}</h4>
          <div class="d-flex justify-content-between align-items-end" style="height:25px;">
            <p class="pd-1">{{$comision->obtenerNombreCurso()}}</p>
            <p>{{$comision->comisionHorario}}</p>
          </div>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="collapseCardExample{{$comision->comisionId}}">
          <div class="card-body">
           
            {{-- <div id="collapse{{$comision->comisionId}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$comision->comisionId}}" data-parent="#accordionEx5"> <!-- Card body --> --}}
            <div class="card-body rgba-black-light white-text z-depth-1 pb-0" style="padding:0px;">
              <table class="table table-striped">
                <thead class="">
                  <tr>
                    <th scope="col">#Matricula</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Nombre </th>
                    <th scope="col">DNI</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($comision->obtenerAlumnos() as $matricula)
                  <tr>
                    <th scope="row">{{$matricula->matriculaId}}</th>
                    <td>{{$matricula->estudiante->estudianteApellido}}</td>
                    <td>{{$matricula->estudiante->estudianteNombre}}</td>
                    <td>{{$matricula->estudiante->estudianteDNI}}</td>
                    <td>
                      <a href="{{route('alumnos.editar',$matricula)}}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#31353D;width:50px;"></i>
                      </a>
                      <a data-toggle="modal" data-target="#exampleModal{{$matricula->matriculaId}}">
                        <i class="fa fa-trash fa-lg" style="color:#31353D"></i>
                      </a>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{$matricula->matriculaId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$matricula->matriculaId}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel{{$matricula->matriculaId}}">Confirmación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              ¿Desea Eliminar el alumno {{$matricula->estudiante->estudianteApellido}}?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <form action="{{route('alumnos.eliminar',$matricula)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-primary">Eliminar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>                      
                  @empty
                    <th>
                      SIN ALUMNO
                    </th>  
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

{{-- 
<div class="rgba-black-strong py-5 px-2 " size="giant"><!-- Content -->
  <div class="row d-flex justify-content-center">
    <div class="col-md-12 col-xl-12">
      <div class="accordion md-accordion accordion-5" id="accordionEx5" role="tablist" aria-multiselectable="true"><!--Accordion wrapper-->
        <div class="card mb-2"><!-- Accordion card -->
          @foreach ($comisiones as $comision)
          <div class="card-header p-1 z-depth-1" style="height: 58px;" role="tab" id="heading{{$comision->comisionId}}"><!-- Card header -->
            <a data-toggle="collapse" data-parent="#accordionEx5" href="#collapse{{$comision->comisionId}}" aria-expanded="true" aria-controls="collapse{{$comision->comisionId}}" style="text-decoration:none;">
              
              <i class="fa fa-ellipsis-v fa-2x p-3 mr-2 float-left" aria-hidden="true"></i>
              <h4>
                {{$comision->comisionNombre}} 
              </h4>
              <div class="d-flex justify-content-between align-items-end" style="height:25px;">
                  <p class="pd-1">{{$comision->obtenerNombreCurso()}}</p>
                  <p>{{$comision->comisionHorario}}</p>
              </div>
              <div>
              </div>
            </a>
          </div>
          <div id="collapse{{$comision->comisionId}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$comision->comisionId}}" data-parent="#accordionEx5"> <!-- Card body -->
            <div class="card-body rgba-black-light white-text z-depth-1 pb-0" style="padding:0px;">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#Matricula</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Nombre </th>
                    <th scope="col">DNI</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($comision->obtenerAlumnos() as $matricula)
                  <tr>
                    <th scope="row">{{$matricula->matriculaId}}</th>
                    <td>{{$matricula->estudiante->estudianteApellido}}</td>
                    <td>{{$matricula->estudiante->estudianteNombre}}</td>
                    <td>{{$matricula->estudiante->estudianteDNI}}</td>
                    <td>
                      <a href="{{route('alumnos.editar',$matricula)}}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#31353D;width:50px;"></i>
                      </a>
                      <a data-toggle="modal" data-target="#exampleModal{{$matricula->matriculaId}}">
                        <i class="fa fa-trash fa-lg" style="color:#31353D"></i>
                      </a>
                      <!-- Modal -->
                      <div class="modal fade" id="exampleModal{{$matricula->matriculaId}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$matricula->matriculaId}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel{{$matricula->matriculaId}}">Confirmación</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              ¿Desea Eliminar el alumno {{$matricula->estudiante->estudianteApellido}}?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <form action="{{route('alumnos.eliminar',$matricula)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-primary">Eliminar</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>                      
                  @empty
                    <th>
                      SIN ALUMNO
                    </th>  
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
          @endforeach
        </div><!-- Accordion card -->        
      </div><!--/.Accordion wrapper-->
    </div>
  </div>
</div><!-- Content --> --}}



@endsection

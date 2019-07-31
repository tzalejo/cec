@extends('layouts.app')

@section('content')
<div class="jumbotrom p-3 p-md-2 rounded db-dark">
  <div class="row mb-2">
    <div class="col">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="">Comisiones</h2>
      </div>
      <table class="table table-striped" >
          <thead >
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
<div class="jumbotrom p-3 p-md-2  rounded dg-dark">
  <div class="row">
    <div class="col">
      <div class="card flex-md-row mb-4 box-shadow h-md-250">
        <div class="card-header">
          Seminario
        </div>
        <div class="card-body">
          <h5 class="card-title">Desarrollo Web</h5>
          <p class="card-text">Se llevara a cabo el dia 1-12-19.</p>
          <a href="#" class="btn btn-primary">Inscripciones</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card flex-md-row mb-4 box-shadow h-md-250">
        <div class="card-header">
          Seminario
        </div>
        <div class="card-body">
          <h5 class="card-title">Ceremonial y Protocolo</h5>
          <p class="card-text">Se llevara a cabo el dia 13-10-19.</p>
          <a href="#" class="btn btn-primary">Inscripciones</a>
        </div>
      </div>
    </div>
  </div>

</div>
{{-- <div class="jumbotrom p-3 p-md-2  rounded dg-dark">
  <div class="row mb-2">
    <div class="col">
      <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Comision 1
              </button>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}

<div class="rgba-black-strong py-5 px-2"><!-- Content -->
  <div class="row d-flex justify-content-center">
    <div class="col-md-12 col-xl-12">
      <div class="accordion md-accordion accordion-5" id="accordionEx5" role="tablist" aria-multiselectable="true"><!--Accordion wrapper-->
        <div class="card mb-2"><!-- Accordion card -->
          @foreach ($comisiones as $comision)
          <div class="card-header p-0 z-depth-1" role="tab" id="heading{{$comision->comisionId}}"><!-- Card header -->
            <a data-toggle="collapse" data-parent="#accordionEx5" href="#collapse{{$comision->comisionId}}" aria-expanded="true" aria-controls="collapse{{$comision->comisionId}}">
              <i class="fa fa-cloud fa-2x p-3 mr-4 float-left black-text" aria-hidden="true"></i>
              <h4 class="text-uppercase white-text mb-0 py-3 mt-1">
                {{$comision->comisionNombre}} - {{$comision->obtenerNombreCurso()}}
              </h4>
            </a>
          </div>
          <div id="collapse{{$comision->comisionId}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$comision->comisionId}}" data-parent="#accordionEx5"> <!-- Card body -->
            <div class="card-body rgba-black-light white-text z-depth-1">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#Matricula</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Nombre </th>
                    <th scope="col">DNI</th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                  </tr>
                </thead>
                <tbody>
                  @forelse ($comision->obtenerAlumnos() as $matricula)
                  <tr>
                    <th scope="row">{{$matricula->matriculaId}}</th>
                    <td>{{$matricula->estudiante->estudianteApellido}}</td>
                    <td>{{$matricula->estudiante->estudianteNombre}}</td>
                    <td>{{$matricula->estudiante->estudianteDNI}}</td>
                    <td style="width:50px;" ><a href="{{route('alumnos.editar',$matricula)}}"><i class="fa fa-pencil fa-2x" style="color:#31353D"></i></a></td>
                    <td style="width:50px;" >
                      <a data-toggle="modal" data-target="#exampleModal{{$matricula->matriculaId}}"><i class="fa fa-times fa-2x" style="color:#31353D"></i></a>
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
</div><!-- Content -->

@endsection

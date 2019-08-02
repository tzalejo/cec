@extends('layouts.app')

@section('content')

<div class="container">
  <div id="calendar">
    {{-- <div class="calendar-yvv w-100">
      <div class="d-flex justify-content-between p-2 border align-items-center border-bottom-0 bg-dark text-white">
        <span class="btn btn-outline-light">&lt;</span><span class="text-uppercase">August - 2019</span><span class="btn btn-outline-light">&gt;</span></div><div class="d-flex border w-100 border-top-0 bg-dark text-white"><div class="d-flex border flex-fill w-100 justify-content-center p-2">Mon</div><div class="d-flex border flex-fill w-100 justify-content-center p-2">Tue</div><div class="d-flex border flex-fill w-100 justify-content-center p-2">Wed</div><div class="d-flex border flex-fill w-100 justify-content-center p-2">Thu</div><div class="d-flex border flex-fill w-100 justify-content-center p-2">Fri</div><div class="d-flex border flex-fill w-100 justify-content-center p-2">Sat</div><div class="d-flex border flex-fill w-100 justify-content-center p-2">Sun</div></div><div class="w-100"><div class="d-flex border w-100 border-top-0"><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn" style="color:transparent">0</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn" style="color:transparent">0</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn" style="color:transparent">0</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-1">1</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-2">2</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-3">3</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-4" style="background: #28a7454d; color: #28a745; font-weight: bold;">4</div></div><div class="d-flex border w-100 border-top-0"><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-5">5</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-6">6</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-7">7</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-8">8</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-9">9</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-10">10</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-11">11</div></div><div class="d-flex border w-100 border-top-0"><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-12">12</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-13">13</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-14">14</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-15" style="background: #28a7454d; color: #28a745; font-weight: bold;">15</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-16">16</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-17">17</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-18">18</div></div><div class="d-flex border w-100 border-top-0"><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-19">19</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-20">20</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-21">21</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-22">22</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-23">23</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-24">24</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-25">25</div></div><div class="d-flex border w-100 border-top-0"><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-26" style="background: #28a7454d; color: #28a745; font-weight: bold;">26</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-27">27</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-28">28</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-29">29</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-30">30</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn btn-rounded-success" data-date="2019-8-31">31</div><div class="d-flex border flex-fill w-100 justify-content-center pt-3 pb-3 btn" style="color:transparent">0</div></div>
      </div>
    </div> --}}
  </div>  
</div>

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

<div class="rgba-black-strong py-5 px-2 " size="giant"><!-- Content -->
  <div class="row d-flex justify-content-center">
    <div class="col-md-12 col-xl-12">
      <div class="accordion md-accordion accordion-5" id="accordionEx5" role="tablist" aria-multiselectable="true"><!--Accordion wrapper-->
        <div class="card mb-2"><!-- Accordion card -->
          @foreach ($comisiones as $comision)
          <div class="card-header p-1 z-depth-1" role="tab" id="heading{{$comision->comisionId}}"><!-- Card header -->
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
</div><!-- Content -->

@endsection

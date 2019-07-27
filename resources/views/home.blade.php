@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h2>Comisiones</h2>
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
              <td>sin datos</td>
              <td>sin datos</td>
              <td>sin datos</td>
              <td>sin datos</td>    
            @endforelse
         
            
          </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="card">
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
    <div class="card">
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

@endsection

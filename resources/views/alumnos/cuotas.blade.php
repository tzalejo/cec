@extends('layouts.app')
@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h2 class="card-title  mb-2">ALUMNO</h2>
    </div>
  </div>
  <form>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input type="text" class="form-control" id="estudianteApellido" placeholder="Apellido" name="estudianteApellido" value="{{$matricula->estudiante->estudianteApellido}}" disabled>
      </div>
      <div class="form-group col-md-6">
        <input type="text" class="form-control" id="estudianteNombre" placeholder="Nombre" name="estudianteNombre" value="{{$matricula->estudiante->estudianteNombre}}" disabled>
      </div>
      <div class="form-group col-md-3">
        <input type="text" class="form-control" id="estudianteDNI" placeholder="DNI" name="estudianteDNI" value="{{$matricula->estudiante->estudianteDNI}}" disabled>
      </div>
      <div class="form-group col-md-9">
        <input type="email" class="form-control" id="estudianteEmail" placeholder="Email" name="estudianteEmail" value="{{$matricula->estudiante->estudianteEmail}}" disabled>
      </div>
      <div class="form-group col-md-12">
        <input type="email" class="form-control" id="estudianteCurso" placeholder="Curso" name="estudianteCurso" value="{{$matricula->comision->curso->cursoNombre}} - {{$matricula->comision->comisionNombre}}" disabled>
      </div>
    </div>
  </form>
  
  <div class="card mt-3">
    <div class="card-header">
      <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h2 class="card-title mb-0 text-gray-800">CUOTAS</h2>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
          <span class="icon text-white-50">
            <i class="fas fa-download fa-sm text-white-50"></i>
          </span>
          <span class="text">Generar Reporte</span>
        </a>

      </div>
    </div>
    <ul class="list-group list-group-flush">
      <div class="row">
        <div class="col-sm-12">
          <table id="example" class="table table-hover table-striped dataTable " style="width: 100%;" role="grid" aria-describedby="example_info">
            <thead class="thead-dark">
              <tr role="row">
                <th scope="col" class="">Codigo</th>
                <th scope="col" class="">Concepto</th>
                <th scope="col" class="">Monto</th>
                <th scope="col" class="d-none d-lg-table-cell">FechaVencimiento</th>
                <th scope="col" class="d-none d-xl-table-cell">Bonificacion</th>
                <th scope="col" class="d-none d-md-table-cell">Abonado</th>
                <th scope="col" class="">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($matricula->cuotas as $cuota)
              <tr role="row" class="odd">
                <a href="#">
                  <td>{{$cuota->cuotaId}}</td>
                  <td>{{$cuota->cuotaConcepto}}</td>
                  <td>{{$cuota->cuotaMonto}}</td>
                  <td class="d-none d-lg-table-cell">{{$cuota->cuotaFVencimiento}}</td>
                  <td class="d-none d-xl-table-cell">{{$cuota->cuotaBonificacion}}</td>
                  <td class="d-none d-md-table-cell">{{$cuota->estadoCuota()}}</td>
                  <td>
                    <a  class="btn @if ($cuota->cuotaPagada()) btn-outline-light @else btn-outline-danger @endif  btn-sm" 
                        href="{{route('alumnos.pago',['cuota' => $cuota])}}"  @if ($cuota->cuotaPagada()) style="cursor: default; pointer-events: none;" onclick="return false;" @endif>
                      Pagar
                    </a>
                    {{-- cancelar una cuota solo si el Usuario es "director"--}}
                    @if ($cuota->cuotaPagada() && Auth::user()->esDirector() )
                      <a  class="btn btn-outline-danger btn-sm" href="#">
                        Cancelar
                      </a>    
                    @endif
                  </td>
                </a>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </ul>
  </div>

</div>

    
@endsection
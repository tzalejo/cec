@extends('layouts.app')
@section('content')
<div class="card">
  <div class="card-header">
    <h2 class="card-title">Alumno</h2>
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
    <h2 class="card-title">Cuotas</h2>
  </div>
  <ul class="list-group list-group-flush">
    <div class="row">
      <div class="col-sm-12">
        <table id="example" class="table table-hover table-striped dataTable " style="width: 100%;" role="grid" aria-describedby="example_info">
          <thead class="thead-dark">
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Codigo: activate to sort column descending" style="width: 49px;">
                Codigo
              </th>
              <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-sort="ascending" aria-label="Concepto: activate to sort column descending" style="width: 49px;">
                Concepto
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Monto: activate to sort column ascending" style="width: 54px;">
                Monto
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-label="FechaVencimiento: activate to sort column ascending" style="width: 45px;">
                FechaVencimiento
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Bonificacion: activate to sort column ascending" style="width: 26px;">
                Bonificacion
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                aria-label="Matricula: activate to sort column ascending" style="width: 56px;">
                Acciones
              </th>
            
            </tr>
          </thead>
          <tbody>
            @foreach ($matricula->cuotas as $cuota)
            <tr role="row" class="odd">
              <a href="#">
                <td class="sorting_1">{{$cuota->cuotaId}}</td>
                <td>{{$cuota->cuotaConcepto}}</td>
                <td>{{$cuota->cuotaMonto}}</td>
                <td>{{$cuota->cuotaFVencimiento}}</td>
                <td>{{$cuota->cuotaBonificacion}}</td>
                <td><button class="btn btn-danger btn-sm" href=""  @if ($cuota->cuotaPagada()) disabled @endif>Pagar</button></td>
              </a>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </ul>
</div>

    
@endsection
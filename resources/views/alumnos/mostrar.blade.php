@extends('layouts.app')
@section('content')
<h1>Estudiantes</h1>

<div class="fw-container">
  <div class="fw-body">
    <div class="content">
      <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="dataTables_length" id="example_length">
              <label>
                <select name="example_length" aria-controls="example" data-width="auto"
                class="custom-select custom-select-sm form-control form-control-sm"
                onchange="location = this.options[this.selectedIndex].value;" >
                  <option>--- Entrada ---</option>
                  <option value="{{route('alumnos.mostrar',['paginado' => 10])}}">10</option>
                  <option value="{{route('alumnos.mostrar',['paginado' => 25])}}">25</option>
                  <option value="{{route('alumnos.mostrar',['paginado' => 50])}}">50</option>
                  <option value="{{route('alumnos.mostrar',['paginado' => 100])}}">100</option>
                </select>
              </label>
            </div>
          </div>
          {{-- <div class="col-sm-12 col-md-6">
            <div id="example_filter" class="dataTables_filter">
              <label>
                Buscar: <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example">
              </label>
            </div>
          </div> --}}
        </div>

        <div class="row">
          <div class="col-sm-12">
            <table id="example" class="table table-hover table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
              <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="Codigo: activate to sort column descending" style="width: 49px;">
                    Codigo
                  </th>
                  <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-sort="ascending" aria-label="DNI: activate to sort column descending" style="width: 49px;">
                    DNI
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-label="Apellido: activate to sort column ascending" style="width: 54px;">
                    Apellido
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-label="Nombre: activate to sort column ascending" style="width: 45px;">
                    Nombre
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-label="Email: activate to sort column ascending" style="width: 26px;">
                    Email
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-label="Telefono: activate to sort column ascending" style="width: 56px;">
                    Telefono
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-label="Localidad: activate to sort column ascending" style="width: 55px;">
                    Localidad
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                    aria-label="Localidad: activate to sort column ascending" style="width: 55px;">
                    Editar
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($estudiantes as $estudiante)
                <tr role="row" class="odd">
                  <a href="#">
                    <td class="sorting_1">{{$estudiante->estudianteId}}</td>
                    <td>{{$estudiante->estudianteDNI}}</td>
                    <td>{{$estudiante->estudianteApellido}}</td>
                    <td>{{$estudiante->estudianteNombre}}</td>
                    <td>{{$estudiante->estudianteEmail}}</td>
                    <td>{{$estudiante->estudianteTelefono}}</td>
                    <td>{{$estudiante->estudianteLocalidad}}</td>
                    <td><a href="{{route('alumnos.editar',['estudiante'=>$estudiante])}}">editar</a></td>
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
            <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
              {{$estudiantes->render()}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
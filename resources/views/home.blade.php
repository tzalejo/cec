@extends('layouts.app')

@section('content')
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
          <th scope="col">Alumnos</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comisiones as $comision)
          <tr>
            {{-- <th scope="row">1</th> --}}
            <td>{{$comision->curso->cursoNombre}}</td>
            <td>{{$comision->comisionNombre}}</td>
            <td>{{$comision->comisionHorario}}</td>
            <td>{{$comision->cantidadAlumnos()}}</td>
            
          </tr>
        @endforeach
        
      </tbody>
</table>

<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
  feather.replace()
</script>
@endsection

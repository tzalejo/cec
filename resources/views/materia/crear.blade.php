@extends('layouts.app')
@section('content')

<div class="jumbotrom">
  <div class="row">
    <div class="col-xl-12">
      <!-- Overflow Hidden inscripcion-->
      <div class="card shadow mb-12">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">MATERIA</h6>
          <p class="mb-4">Las planillas de creación de Materia.</p>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('materia.guardar')}}">
            @csrf
            <div class="form-row">  
              <div class="form-group col-md-6">
                <label for="materiaNombre">Nombre Materia</label>
                <input type="text" autofocus  class="form-control @error('materiaNombre') is-invalid @enderror" id="materiaNombre" placeholder="Nombre del Curso" name="materiaNombre" value="{{old('materiaNombre')}}">
                @error('materiaNombre')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              
              <div class="form-group col-md-9">
                <fieldset class="form-group">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="materiaSeminario" id="materia" value="materia" checked>
                        <label class="form-check-label" for="materia">
                          Materia
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="materiaSeminario" id="seminario" value="seminario">
                        <label class="form-check-label" for="seminario">
                          Seminario
                        </label>
                      </div>
                    </div>
                  </div>
                  @error('materiaSeminario')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </fieldset>
              </div>
    
            </div>
            
            <button type="submit" class="btn btn-primary">Crear Curso</button>
            <a href="{{route('home')}}" class="btn btn-primary">Cancelar</a>
          </form>
          <br>
          <div class="form-row "> 
            <div class="form-group col-md-12">
              <div class="table-responsive-lg">
                <table class="table table-sm table-hover">
                  <thead class="thead-dark" cellspacing="0">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><a>Materia <i class="icon-sort"></i></a></th>
                        <th scope="col" class="text-right">Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="table-responsive-lg table-wrapper-scroll-y my-custom-scrollbar">
                <table class="table table-sm table-hover">
                  <tbody>
                    @each('materia._row', $materias, 'materia')
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
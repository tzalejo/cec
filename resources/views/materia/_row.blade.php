<tr id="{{ $materia->materiaId }}">
    <th>{{ $materia->materiaId }}</th>
    <td scope="row">
        {{ $materia->materiaNombre }}
        @if ($materia->materiaSeminario)
          <span class="note">(Seminario)</span> 
        @else
          <span class="note">(Materia)</span>
        @endif
    </td>
    <td class="text-right">
      <form action="{{ route('materia.eliminar',$materia) }}" method="POST">
        @method('DELETE')
        @csrf
        <a href="#" class="btn btn-outline-secondary btn-sm">
          <i class="fas fa-pen"></i>
        </a>
        <button type="submit" class="btn btn-outline-danger btn-sm">
          <i class="far fa-trash-alt"></i>
        </button>
      </form>
    </td>
</tr>

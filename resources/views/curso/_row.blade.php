<tr id="{{ $materia->materiaId }}">
    <td>{{ $materia->materiaId }}</td>
    <th scope="row">
        {{ $materia->materiaNombre }}
        @if ($materia->materiaSeminario)
          <span class="note">(Seminario)</span> 
        @else
          <span class="note">(Materia)</span>
        @endif
    </th>
    <th><input type="checkbox" name="sele_materia[]" value="{{ $materia->materiaId }}" id="checkbox{{ $materia->materiaId }}"></th>
</tr>

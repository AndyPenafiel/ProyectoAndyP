<style>
  .table tr td {
    padding: 3px;
    border:solid 1px #26c6da;  
  }
  .table tr th {
    border:solid 1px #26c6da;  
  }
  .vertical-text {
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    white-space: nowrap;
  }
</style>
<table class="table table-sm border border-success mt-2">
  <br>
    <tr>
        <th>#</th>
        <th>Estudiante</th>
        <th class="vertical-text">Enero</th>
        <th class="vertical-text">Febrero</th>
        <th class="vertical-text">Marzo</th>
        <th class="vertical-text">Abril</th>
        <th class="vertical-text">Mayo</th>
        <th class="vertical-text">Junio</th>
        <th class="vertical-text">Julio</th>
        <th class="vertical-text">Agosto</th>
        <th class="vertical-text">Septiembre</th>
        <th class="vertical-text">Octubre</th>
        <th class="vertical-text">Noviembre</th>
        <th class="vertical-text">Diciembre</th>
    </tr>
    @forelse($datos as $d)
        @php
            $enero = validarMes($d->e);
            $febrero = validarMes($d->f);
            $marzo = validarMes($d->m);
            $abril = validarMes($d->a);
            $mayo = validarMes($d->my);
            $junio = validarMes($d->j);
            $julio = validarMes($d->jl);
            $agosto = validarMes($d->ag);
            $septiembre = validarMes($d->s);
            $octubre = validarMes($d->o);
            $noviembre = validarMes($d->n);
            $diciembre = validarMes($d->d);
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->est }}</td>
            <td class="{{ $enero['cls'] }}">{{ $enero['estado'] == 1 ? '(Doc:' . $enero['doc'] . ') - $' . $enero['valor'] : '' }}</td>
            <td class="{{ $febrero['cls'] }}">{{ $febrero['estado'] == 1 ? '(Doc:' . $febrero['doc'] . ') - $' . $febrero['valor'] : '' }}</td>
            <td class="{{ $marzo['cls'] }}">{{ $marzo['estado'] == 1 ? '(Doc:' . $marzo['doc'] . ') - $' . $marzo['valor'] : '' }}</td>
            <td class="{{ $abril['cls'] }}">{{ $abril['estado'] == 1 ? '(Doc:' . $abril['doc'] . ') - $' . $abril['valor'] : '' }}</td>
            <td class="{{ $mayo['cls'] }}">{{ $mayo['estado'] == 1 ? '(Doc:' . $mayo['doc'] . ') - $' . $mayo['valor'] : '' }}</td>
            <td class="{{ $junio['cls'] }}">{{ $junio['estado'] == 1 ? '(Doc:' . $junio['doc'] . ') - $' . $junio['valor'] : '' }}</td>
            <td class="{{ $julio['cls'] }}">{{ $julio['estado'] == 1 ? '(Doc:' . $julio['doc'] . ') - $' . $julio['valor'] : '' }}</td>
            <td class="{{ $agosto['cls'] }}">{{ $agosto['estado'] == 1 ? '(Doc:' . $agosto['doc'] . ') - $' . $agosto['valor'] : '' }}</td>
            <td class="{{ $septiembre['cls'] }}">{{ $septiembre['estado'] == 1 ? '(Doc:' . $septiembre['doc'] . ') - $' . $septiembre['valor'] : '' }}</td>
            <td class="{{ $octubre['cls'] }}">{{ $octubre['estado'] == 1 ? '(Doc:' . $octubre['doc'] . ') - $' . $octubre['valor'] : '' }}</td>
            <td class="{{ $noviembre['cls'] }}">{{ $noviembre['estado'] == 1 ? '(Doc:' . $noviembre['doc'] . ') - $' . $noviembre['valor'] : '' }}</td>
            <td class="{{ $diciembre['cls'] }}">{{ $diciembre['estado'] == 1 ? '(Doc:' . $diciembre['doc'] . ') - $' . $diciembre['valor'] : '' }}</td>
        </tr>
    @empty
    <br>
       <div class="alert alert-danger" >NO EXISTEN ORDENES GENERADAS PARA ÉSTA BÚSQUEDA</div>
       <br>
    @endforelse
</table>

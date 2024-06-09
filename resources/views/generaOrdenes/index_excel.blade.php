<table>
    @foreach ($datos as $d )
    @php
    //  dd($d);   
    @endphp
        <tr>
        <td>CO</td>
        <td>{{ $d->est_cedula }}</td>
        <td>USD</td>
        <td>{{ $d->valor_pagar }}</td>
        <td>REC</td>
        <td></td>
        <td></td>
        <td>{{ $d->codigo }}</td>
        <td>N</td>
        </tr>
    @endforeach
</table>
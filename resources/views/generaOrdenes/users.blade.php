<table>
    @foreach ($usuarios as $u )
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $loop->email }}</td>
    </tr>
    @endforeach
</table>
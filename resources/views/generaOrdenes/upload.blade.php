@extends('layouts.app')
@section('content')
<script>

function validar() {
    const fileInput = $("#orden_file")[0];
    if (fileInput.files.length === 0) {
        alert('Elija un archivo');
        return false;
    }
    return true;
}

</script>
<div class="container">
      <div class="text-center bg-success text-white">SUBIR ARCHIVOS DESDE EL CASH</div>
        <br>
      <div class="file_container border border-success rounded p-3 mt-3" style="width:50%" >
         <form action="{{ route('genera_ordenes.upload_file') }}" onsubmit="return validar()" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
             <div class="col-md-8 ">
                <input type="file" style="width:300px"  name="orden_file" id="orden_file">
             </div>
             <div class="col-md-4">
                <button type="submit" class="btn btn-info text-white" >Subir</button>
             </div>
            </div>
         </form>
      </div>



</div>
<hr size="1">
<table class="table border border-success">
       <tr class="bg-success text-white">
           <th>#</th>
           <th>Nombre del Documento</th>
           <th>Fecha de Registro</th>
           <th>Responsable</th>
           <th>Secuencial del Documento</th>
           <th>...</th>
       </tr>
   <tbody>
       @foreach($documentos as $documento)
           <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $documento->nombre_documento }}</td>
               <td>{{ $documento->fecha_registro }}</td>
               <td>{{ $documento->responsable }}</td>
               <td>{{ $documento->secuencial_documento }}</td>
               <td>
                  <div class="btn-group">
                     <a href="{{ route('genera_ordenes.upload_show',$documento->secuencial_documento) }}" class="btn btn-default btn-xs "><i class="fa fa-eye"></i></a>
                  </div> 
               </td>
           </tr>
       @endforeach
   </tbody>
</table>
@endsection



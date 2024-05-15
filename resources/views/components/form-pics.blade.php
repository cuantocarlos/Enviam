<!--Hecho por mi-->
<div>
    <!--boton formulario subir fotos -->
    
    <form action="{{ route('multimedia.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pics" >
        <input type="hidden" name="moment_id" value="{{ $moment->id }}">
        <button type="submit">Añadir fotos</button>
    </form>
</div>

<h2>Form. crear momento</h2>

<form method="POST" action="{{ route('moment.store') }}">
    @csrf
    <label for="">Nombre</label>
    <input type="text" value="Bautizo" name="name">
</br>
    <label for="">Descripción</label>
    <input type="text" value="Bauizo de ana y antonia" name="description">
</br>
    <button type="submit">Enviar</button>
</form>








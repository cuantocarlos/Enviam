
<h2>Form. crear momento</h2>

<form method="POST" action="{{ route('moment.store') }}">
    @csrf
    <label for="">Nombre</label>
    <input type="text" value="Marcos" name="name">
</br>
    <label for="">Descripción</label>
    <input type="text" value="Boda de ana" name="description">
</br>
    <button type="submit">Enviar</button>
</form>








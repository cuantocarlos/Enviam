
<h2>Listado de todos los momentos existentes</h2>


@if ($moments)
    <ul>
            @foreach($moments as $moment)
                <li>{{ $moment->name }}</li>
            @endforeach
        
    </ul>
@else
    <p>NO HAY MOMENTOS</p>
@endif


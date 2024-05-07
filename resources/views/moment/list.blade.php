
<h2>Listado de todos los momentos existentes</h2>


@if ($moments)
    <ul>
            @foreach($moments as $moment)
                <li>{{ $moment->name }}</li>

                @if ($moment->user)
                    <p>Usuario: {{ $moment->user->nick }}</p>
                @else
                    <p>No se encontró un usuario asociado a este momento.</p>
                @endif
            @endforeach
        
    </ul>
@else
    <p>NO HAY MOMENTOS</p>
@endif


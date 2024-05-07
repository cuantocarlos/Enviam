
<h2>Todas las fotos que se han subido</h2>


@if ($multimedia)
    <ul>
        @foreach($multimedia as $media)
            <li>
                <img src="{{ $media->url }}" alt="{{ $media->name }}">
            </li>
        @endforeach
    </ul>
@else
    <p>NO HAY IMÁGENES</p>

@endif

<h2>Todas las fotos que se han subido</h2>


@if ($multimedia)
    <div class="gallery">
        @foreach ($multimedia as $media)
            <a href="{{ route('moment.show', $media->moment_id) }}">
                <img src="{{ asset('storage/moments/' . $media->moment_id . '/' . $media->name) }}" width="180" height="120">
            </a>
        @endforeach
    </div>
@else
    <p>NO HAY IMÁGENES</p>
@endif

<div>
    @if ($multimedia)
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($multimedia as $media)
                <div>
                    <a href="{{ route('moment.show', $media->moment_id) }}">
                        <img class="h-auto max-w-full rounded-lg"
                            src="{{ asset('storage/moments/' . $media->moment_id . '/' . $media->name) }}" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p>NO HAY CONTENIDO</p>
    @endif
</div>

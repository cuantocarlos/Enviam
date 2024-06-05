<div>
    @if ($multimedia)
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($multimedia as $media)
                <div>
                    <img class="h-auto max-w-full rounded-lg"
                        src="{{ asset('storage/moments/' . $media->moment_id . '/' . $media->name) }}" alt="">
                    <div class="desc">{{ $media->description }}</div>
                </div>
            @endforeach
        </div>
    @else
        <p>NO HAY CONTENIDO</p>
    @endif
</div>

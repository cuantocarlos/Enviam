<div>
        
    @extends('layouts.app')

        @section('content')
        <div class="container">
            <h1>{{ $moment->name }}</h1>
            <p>{{ $moment->description }}</p>
            <p>{{ $moment->created_at }}</p>
            <p>{{ $moment->user->name }}</p>
        </div>

{{-- Galería multimedia --}}
@if ($moment->multimedia)
    <ul>
            @foreach($moment->multimedia  as $media)
                
                <img src="{{ asset('storage/moments/' . $moment->id . '/' . $media->name) }}" width="200" height="133">


                {{--  --}}

            @endforeach
        
    </ul>
@else
    <p>NO HAY CONTENIDO</p>
@endif


        {{-- componente de formulario de fotos --}}
        <form action="{{ route('multimedia.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="pics[]" multiple>

            <input type="hidden" name="moment_id" value="{{ $moment->id }}">
            <button type="submit">Añadir fotos</button>
        </form> 
        @endsection
        
</div>

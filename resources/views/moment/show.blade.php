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
                @foreach ($moment->multimedia as $media)
                    <img src="{{ asset('storage/moments/' . $moment->id . '/' . $media->name) }}" width="200" height="133">
                @endforeach
            </ul>
        @else
            <p>NO HAY CONTENIDO</p>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- componente de formulario de fotos --}}
        <form action="{{ route('multimedia.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        
            <!-- Campo para seleccionar las fotos -->
            <div class="form-group">
                <label for="pics">{{ __('Selecciona las fotos') }}</label>
                <input type="file" id="pics" name="pics[]" multiple class="form-control">
            </div>
        
            <!-- Campo oculto para el ID del momento -->
            <input type="hidden" name="moment_id" value="{{ $moment->id }}">
        
            <!-- Botón para enviar el formulario -->
            <div class="form-group">
                <x-primary-button class="ms-4">
                    {{ __('Añadir fotos') }}
                </x-primary-button>
            </div>
        </form>

        {{-- button download all --}}
        {{-- <a href="{{ route('multimedia.downloadMoment', $moment->id) }}">Descargar todas las fotos</a> --}}

    @endsection

</div>

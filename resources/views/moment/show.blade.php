<x-app-layout>
    <head>
        <style>
            div.gallery {
                margin: 5px;
                border: 1px solid #ccc;
                float: left;
                width: 180px;
            }

            div.gallery:hover {
                border: 1px solid #777;
            }

            div.gallery img {
                width: 100%;
                height: auto;
            }

            div.desc {
                padding: 15px;
                text-align: center;
            }
        </style>
    </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Este es tu Momento !') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <h1>{{ $moment->name }}</h1>
                        <p>{{ $moment->description }}</p>
                        <p>{{ $moment->created_at }}</p>
                        <p>{{ optional($moment->user)->name }}</p>
                    </div>

                    {{-- Galería multimedia --}}

                    @if ($moment->multimedia)
                        <div class="gallery">
                            @foreach ($moment->multimedia as $media)
                                <img src="{{ asset('storage/moments/' . $moment->id . '/' . $media->name) }}" width="180" height="120">
                                <div class="desc">{{ $media->description }}</div>
                            @endforeach
                        </div>
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
                    <!--boton para copiar momento-->
                    <div class="form-group">
                        <x-primary-button class="ms-4" onclick="copyToClipboard()">
                            {{ __('Copiar URL') }}
                        </x-primary-button>
                    </div>
                    <!--boton para eliminar momento-->
                    <form method="POST" action="{{ route('moment.destroy', $moment->id) }}">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class="ms-4" type="submit">{{ __('Eliminar Momento') }}</x-primary-button>
                    </form>
                    

                    {{-- button download all --}}
                    {{-- <a href="{{ route('multimedia.downloadMoment', $moment->id) }}">Descargar todas las fotos</a> --}}



                    <script>
                        function copyToClipboard() {
                            var dummy = document.createElement('input'),
                            text = window.location.href;
                    
                            document.body.appendChild(dummy);
                            dummy.value = text;
                            dummy.select();
                            document.execCommand('copy');
                            document.body.removeChild(dummy);
                    
                            alert('URL copiada al portapapeles');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('This is your Moment!') }}
        </h2>
    </x-slot>

    <!-- Check if the moment does not exist -->
    @if ($moment === null)
        <p>¡Parece que intentas acceder a un enlace que no contiene nada! <br>
            NO HAY CONTENIDO, este momento no existe
        </p>
        <img src="{{ asset('images/stock-image-sad-dog.jpg') }}" class="error">
    @else
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

                        {{-- New Gallery --}}
                        @include('components.galleryShow')

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

                        <!--Buttons-->
                        <div class="form-group flex justify-evenly">
                            {{-- Photo upload form component --}}
                            {{-- <form action="{{ route('multimedia.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Field to select photos -->
                                <div class="form-group">
                                    <label for="pics">{{ __('Select Photos') }}</label>
                                    <input type="file" id="pics" name="pics[]" multiple
                                        accept="image/*,video/*" class="form-control">
                                </div>

                                <!-- Hidden field for moment ID -->
                                <input type="hidden" name="moment_id" value="{{ $moment->id }}">

                                <!-- Button to submit the form -->
                                <div class="form-group">
                                    <x-primary-button class="ms-4" id="submit-button">
                                        {{ __('Add Photos') }}
                                    </x-primary-button>
                                </div>
                            </form> --}}
                            <form id="upload-form" action="{{ route('multimedia.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Campo para seleccionar fotos -->
                                <div class="form-group">
                                    <label for="pics">{{ __('Select Photos') }}</label>
                                    <input type="file" id="pics" name="pics[]" multiple
                                        accept="image/*,video/*" class="form-control">
                                </div>

                                <!-- Campo oculto para el ID del momento -->
                                <input type="hidden" name="moment_id" value="{{ $moment->id }}">

                                <!-- Botón para enviar el formulario -->
                                <div class="form-group">
                                    <x-primary-button class="ms-4" id="submit-button" type="button"
                                        style="display: none;">
                                        {{ __('Add Photos') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <!-- Botón para copiar URL del momento -->
                            <div class="form-group">
                                <x-primary-button class="ms-4" onclick="copyToClipboard()">
                                    {{ __('Copy URL') }}
                                </x-primary-button>
                            </div>

                            <!-- Botón para eliminar momento -->
                            <form method="POST" action="{{ route('moment.destroy', $moment->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="ms-4" type="submit">
                                    {{ __('Delete Moment') }}
                                </x-primary-button>
                            </form>
                        </div>


                        <script>
                            // Script to copy the URL to the clipboard
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

                            // Obtén referencias a los elementos del DOM
                            var fileInput = document.getElementById('pics');
                            var submitButton = document.getElementById('submit-button');

                            // Deshabilita el botón de envío al inicio
                            submitButton.disabled = true;

                            // Agrega un controlador de eventos al input de archivos
                            fileInput.onchange = function(e) {
                                var files = this.files;

                                // Si no se seleccionaron archivos, deshabilita el botón de envío
                                if (files.length === 0) {
                                    submitButton.disabled = true;
                                } else {
                                    // Si se seleccionaron archivos, habilita el botón de envío
                                    submitButton.disabled = false;

                                    // Valida el tipo de archivo seleccionado
                                    for (var i = 0; i < files.length; i++) {
                                        var file = files[i];
                                        if (!file.type.match('image.*') && !file.type.match('video.*')) {
                                            alert("Por favor, selecciona un archivo de imagen o video.");
                                            this.value = ''; // Clear the input
                                            submitButton.disabled = true; // Disable the submit button again
                                            break;
                                        }
                                    }
                                }
                            }


                            document.getElementById('pics').addEventListener('change', function() {
                                if (this.files.length > 0) {
                                    document.getElementById('upload-form').submit();
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>

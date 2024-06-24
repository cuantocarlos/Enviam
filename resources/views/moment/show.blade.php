<style>
    .grid-item {
        margin-bottom: 16px; /* Ajusta el espaciado según sea necesario */
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- {{ __('dic.This is your Moment!') }} --}}


            @if ($moment === null)
                {{ __('dic.Moment not found') }}
            @else
                {{ $moment->name }}
            @endif

        </h2>
    </x-slot>

    <!-- Check if the moment does not exist -->
    @if ($moment === null)
        <p>{{ __('dic.look_you_try') }}<br>
            {{ __('dic.no_content') }}
        </p>
        <a href="{{ route('moment.create') }}">
            <img src="{{ asset('images/stock-image-sad-dog.jpg') }}" class="error">
        </a>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-4 p-6 text-gray-900 dark:text-gray-100">
                        <div class="">
                            <h1></h1>
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
                        <div
                            class="flex fixed flex-wrap justify-center gap-2 w-full md:w-auto bg-white rounded-lg md:rounded-full py-4 px-6 left-1/2 transform -translate-x-1/2 bottom-0 md:bottom-4">
                            <form id="upload-form" class="m-0" action="{{ route('multimedia.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                    <!-- Campo para añadir fotos -->
                                <div class="form-group flex flex-wrap gap-1 items-center">
                                    {{-- <label for="pics" class="whitespace-nowrap">{{ __('Select Photos') }}</label> --}}
                                    <input type="file" id="pics" name="pics[]" multiple
                                        accept="image/*,video/*" class="hidden">
                                    <x-primary-button class="" id="file-button" type="button">
                                        {{ __('dic.add_photos') }}
                                    </x-primary-button>

                                    <script>
                                        (function() {
                                            const fileButton = document.getElementById('file-button');
                                            const fileInput = document.getElementById('pics');

                                            fileButton.addEventListener('click', function() {
                                                fileInput.click();
                                            });
                                        })();
                                    </script>
                                </div>

                                <!-- Campo oculto para el ID del momento -->
                                <input type="hidden" name="moment_id" value="{{ $moment->id }}">

                    <!-- Botón para enviar el formulario -->
                                <div class="form-group">
                                    <x-primary-button class="" id="submit-button" type="button"
                                        style="display: none;">
                                        {{ __('dic.add_photos') }}
                                    </x-primary-button>
                                </div>
                            </form>

                    <!-- Botón para copiar URL del momento -->
                            <div class="form-group">
                                <x-primary-button class="whitespace-nowrap" onclick="copyToClipboard()">
                                    {{ __('dic.Copy URL') }}
                                </x-primary-button>
                            </div>

                            @if (
                                $moment &&
                                    (is_null($moment->user_id) ||
                                        (auth()->check() && (auth()->id() == $moment->user_id || auth()->user()->hasRole('admin')))))
                    <!-- Botón para descargar Momento -->
                                <form method="GET" class="m-0" action="{{ route('moment.download', $moment->id) }}">
                                    @csrf
                                    <x-primary-button class="whitespace-nowrap" type="submit">
                                        {{ __('dic.download_moment') }}
                                    </x-primary-button>
                                </form>
                    <!-- Botón para eliminar momento -->
                                <form method="POST" class="m-0" action="{{ route('moment.destroy', $moment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button class="whitespace-nowrap" type="submit">
                                        {{ __('dic.Delete Moment') }}
                                    </x-primary-button>
                                </form>
                            @endif

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

    @if (!is_null($moment) && (is_null($moment->user_id) || (auth()->check() && auth()->user() && ($moment->user_id == auth()->id() || auth()->user()->hasRole('admin')))))
        <script>
            userCanDelete = true;
        </script>
    @endif

</x-app-layout>

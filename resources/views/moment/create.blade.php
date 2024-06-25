<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('dic.Create a Moment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('moment.createNewMoment') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">
                                {{ __('dic.name_moment') }}</label>
                            <input type="text" name="name" id="name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-6">
                            <label for="description"
                                class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">
                                {{ __('dic.description') }}</label>
                            <textarea name="description" id="description"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>

                        {{-- <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                Crear Momento
                            </button>
                        </div>  --}}
                        <!-- Campo para seleccionar las fotos -->
                        <div class="flex flex-col sm:flex-row items-center">
                            <div class="form-group">
                                {{-- <label for="pics">{{ __('Selecciona las fotos') }}</label> --}}
                                <input type="file" id="pics" name="pics[]" multiple class="form-control">
                            </div>
                            <x-primary-button class="mt-4 sm:mt-0 sm:ms-4">
                                {{ __('dic.create_moment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

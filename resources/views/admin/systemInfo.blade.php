<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema - Información del Sistema</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Main Content -->
        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h1 class="text-2xl font-bold mb-6">Información del Sistema</h1>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- PHP Version -->
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-blue-800">Versión PHP</h3>
                                <p class="text-blue-600 text-lg">{{ PHP_VERSION }}</p>
                            </div>

                            <!-- Laravel Version -->
                            <div class="bg-green-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-green-800">Versión Laravel</h3>
                                <p class="text-green-600 text-lg">{{ app()->version() }}</p>
                            </div>

                            <!-- Environment -->
                            <div class="bg-purple-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-purple-800">Entorno</h3>
                                <p class="text-purple-600 text-lg">{{ app()->environment() }}</p>
                            </div>

                            <!-- Database -->
                            <div class="bg-yellow-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-yellow-800">Base de Datos</h3>
                                <p class="text-yellow-600">{{ config('database.default') }}</p>
                            </div>

                            <!-- Cache -->
                            <div class="bg-red-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-red-800">Sistema de Cache</h3>
                                <p class="text-red-600">{{ config('cache.default') }}</p>
                            </div>

                            <!-- Session -->
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <h3 class="font-semibold text-indigo-800">Sistema de Sesión</h3>
                                <p class="text-indigo-600">{{ config('session.driver') }}</p>
                            </div>
                        </div>

                        <!-- System Details -->
                        <div class="mt-8">
                            <h2 class="text-xl font-bold mb-4">Detalles del Sistema</h2>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <strong>Sistema Operativo:</strong> {{ php_uname() }}
                                    </div>
                                    <div>
                                        <strong>Memoria Límite:</strong> {{ ini_get('memory_limit') }}
                                    </div>
                                    <div>
                                        <strong>Tiempo Máximo de Ejecución:</strong> {{ ini_get('max_execution_time') }} segundos
                                    </div>
                                    <div>
                                        <strong>Zona Horaria:</strong> {{ config('app.timezone') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PHP Extensions -->
                        <div class="mt-8">
                            <h2 class="text-xl font-bold mb-4">Extensiones PHP Cargadas</h2>
                            <div class="bg-gray-50 p-4 rounded-lg max-h-64 overflow-y-auto">
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                    @foreach(get_loaded_extensions() as $extension)
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">{{ $extension }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
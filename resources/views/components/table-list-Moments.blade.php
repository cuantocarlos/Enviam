@if ($moments)
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre del Momento</th>
                <th scope="col" class="px-6 py-3">Descripción</th>
                <th scope="col" class="px-6 py-3">Nick del creador</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($moments as $moment)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('moment.show', $moment->id) }}">{{ $moment->name }}</a>
                    </th>
                    <td class="px-6 py-4">{{ $moment->description }}</td>
                    <td class="px-6 py-4">
                        @if ($moment->user)
                            {{ $moment->user->nick }}
                        @else
                            No se encontró un usuario asociado a este momento.
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        {{-- @if ($moment->user_id == auth()->id() || auth()->user()->hasRole('admin')) --}}
                        <form method="POST" action="{{ route('moment.destroy', $moment->id) }}">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="ms-4">
                                {{ __('Delete Moment') }}
                            </x-primary-button>
                        </form>
                        {{-- @endif --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">NO HAY MOMENTOS</p>
@endif

    <h2>Listado de todos los momentos existentes</h2>
    @if ($moments)
        <table>
            <thead>
                <tr>
                    <th>Nombre del Momento</th>
                    <th>Descripción</th>
                    <th>Nick del creador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($moments as $moment)
                    <tr>
                        <td><a href="{{ route('moment.show', $moment->id) }}">{{ $moment->name }}</a></td>
                        <td>{{ $moment->description }}</td>
                        <td>
                            @if ($moment->user)
                                {{ $moment->user->nick }}
                            @else
                                No se encontró un usuario asociado a este momento.
                            @endif
                        </td>
                        <td>
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
        <p>NO HAY MOMENTOS</p>
    @endif
    

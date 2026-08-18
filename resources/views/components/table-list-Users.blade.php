@if ($users)
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">{{ __('dic.name') }}</th>
                <th scope="col" class="px-6 py-3">{{ __('Email') }}</th>
                <th scope="col" class="px-6 py-3 text-center">{{ __('Role') }}</th>
                <th scope="col" class="px-6 py-3 text-center">{{ __('dic.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->nick }}
                    </td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-center">
                        {{ $user->role ?? __('dic.no_registered_user') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if (auth()->user()->id === $user->id || auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="ms-4">
                                    {{ __('dic.Delete') }}
                                </x-primary-button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">{{ __('No users found') }}</p>
@endif

<x-layout>
    <x-slot:heading>
        User Index Page for {{ $user->first_name }} {{ $user->last_name }}
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/" :active="request()->is('/')">User_create</x-nav-link>
        <x-nav-link href="/index" :active="request()->is('/index')">User_index</x-nav-link>
    </x-slot:nav>
    @auth
        <x-table>
            @foreach ($appointments as $appointment)
                @if ($appointment->email === $user->email)
                    <x-table-row href="/user/{{ $appointment->id }}/edit">
                        <x-slot:client_name>
                            {{ $appointment->first_name }} {{ $appointment->last_name }}
                        </x-slot:client_name>
                        <x-slot:phone>
                            {{ $appointment->phone }}
                        </x-slot:phone>
                        <x-slot:email>
                            {{ $appointment->email }}
                        </x-slot:email>
                        <x-slot:car_license>
                            {{ $appointment->car_license }}
                        </x-slot:car_license>
                        <x-slot:appointment_date>
                            {{ $appointment->appointment_date }}
                        </x-slot:appointment_date>
                        <x-slot:mechanic>
                            {{ $appointment->mechanic }}
                        </x-slot:mechanic>
                    </x-table-row>
                @endif
            @endforeach
        </x-table>
    @endauth
</x-layout>

@php
    $mechanic = $user->first_name . ' ' . $user->last_name;
@endphp

<x-layout>
    <x-slot:heading>
        Mechanic Index Page for {{ $mechanic }}
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/" :active="request()->is('/')">User</x-nav-link>
        <x-nav-link href="/admin" :active="request()->is('admin')">Admin</x-nav-link>
        <x-nav-link href="/mechanic" :active="request()->is('mechanic')">Mechanic</x-nav-link>
    </x-slot:nav>
    @auth
        <x-table>
            @foreach ($appointments as $appointment)
                @if ($appointment->mechanic === $mechanic)
                    <x-table-row href="/admin/{{ $appointment->id }}/edit">
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

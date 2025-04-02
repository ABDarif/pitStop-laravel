<x-layout>
    <x-slot:heading>
        Admin Index Page
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/admin" :active="request()->is('/admin')">Admin_index</x-nav-link>
        <x-nav-link href="/admin/show" :active="request()->is('/admin/show')">Admin_show</x-nav-link>
    </x-slot:nav>
    @auth
        <x-table>
            @foreach ($appointments as $appointment)
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
            @endforeach
        </x-table>
    @endauth
</x-layout>

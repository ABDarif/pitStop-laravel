<x-layout>
    <x-slot:heading>
        Mechanic Page
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/" :active="request()->is('/')">User</x-nav-link>
        <x-nav-link href="/admin" :active="request()->is('admin')">Admin</x-nav-link>
        <x-nav-link href="/mechanic" :active="request()->is('mechanic')">Mechanic</x-nav-link>
    </x-slot:nav>
    @foreach ($appointments as $appointment)
        <li>{{ $appointment['appointment_date'] }}</li>
        <p>{{ $appointment['name'] }} -> {{ $appointment['phone'] }} -> {{ $appointment['address'] }}</p>
    @endforeach
</x-layout>

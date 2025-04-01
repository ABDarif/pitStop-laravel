<x-layout>
    <x-slot:heading>
        Mechanic Page
    </x-slot:heading>
    @foreach ($appointments as $appointment)
    <li>{{ $appointment['appointment_date'] }}</li>
    <p>{{ $appointment['name'] }} -> {{ $appointment['phone'] }} -> {{ $appointment['address'] }}</p>
    @endforeach
</x-layout>

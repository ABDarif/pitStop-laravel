<x-layout>
    <x-slot:heading>
        User Index Page
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/" :active="request()->is('/')">User_create</x-nav-link>
        <x-nav-link href="/index" :active="request()->is('/index')">User_index</x-nav-link>
    </x-slot:nav>
</x-layout>

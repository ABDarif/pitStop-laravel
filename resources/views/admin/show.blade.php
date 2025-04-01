<x-layout>
    <x-slot:heading>
        Admin Show Page
    </x-slot:heading>
    <x-slot:nav>
        <x-nav-link href="/admin/index" :active="request()->is('/admin/index')">Admin_index</x-nav-link>
        <x-nav-link href="/admin/show" :active="request()->is('/admin/show')">Admin_show</x-nav-link>
    </x-slot:nav>
</x-layout>

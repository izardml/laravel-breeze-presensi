<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(request()->routeIs('guru.create'))
                {{ __('Buat Presensi') }}
            @elseif(request()->routeIs('siswa.edit'))
                {{ __('Presensi ' . $attendance->date . ' - ' . $attendance->class_id) }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session()->has('message'))
            <x-notification class="bg-{{ session('color') }}-500">
                <div class="flex justify-between items-center w-full">
                    {{ __(session('message')) }}

                    <x-secondary-button class="bg-transparent text-white hover:bg-white hover:text-{{ session('color') }}-500 closealertbutton bg">Close</x-secondary-button>
                </div>
            </x-notification>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if(request()->routeIs('guru.create'))
                        @include('attendance.partials.tambah')
                    @elseif(request()->routeIs('siswa.edit'))
                        @include('attendance.partials.edit')
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

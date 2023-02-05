<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @php
                $user = Auth::user();
            @endphp
            {{ __('Dashboard ' . ucwords($user->role) . ' - ' . $user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('message'))
            <x-notification class="bg-{{ session('color') }}-500">
                <div class="flex justify-between items-center w-full">
                    {{ __(session('message')) }}
                    <x-secondary-button class="bg-transparent text-white hover:bg-white hover:text-{{ session('color') }}-500 closealertbutton bg">Close</x-secondary-button>
                </div>
            </x-notification>
            @endif

            @foreach($attendances as $attendance)
            <x-notification class="bg-red-500 mb-4 hidden" id="notification-{{ $attendance->id }}">
                <div class="flex justify-between items-center w-full">
                    <p class="inline-block">Yakin {{ $attendance->topic }} mau dihapus?</p>
                    <div class="inline-block">
                        <form method="post" action="{{ route('guru.destroy', $attendance->id) }}" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <x-secondary-button type="submit" class="text-red-500">Ya, hapus</x-secondary-button>
                        </form>
                        <x-secondary-button class="bg-transparent text-white hover:bg-white hover:text-red-500" onclick="document.getElementById('notification-{{ $attendance->id }}').classList.add('hidden')">Ga jadi deh</x-secondary-button>
                    </div>
                </div>
            </x-notification>
            @endforeach

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full overflow-hidden shadow">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Teacher</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Subject</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Class</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Topic</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @php
                                    $no = 1 * (isset($_GET['page']) ? $_GET['page'] * 5 - 4 : 1);
                                @endphp
                                @foreach($attendances as $attendance)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $no }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attendance->teacher_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attendance->subject_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attendance->class_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attendance->date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attendance->topic }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                                        @if($user->role == 'guru')
                                        <a href="{{ route('guru.show', $attendance->id) }}"><x-primary-button>Detail</x-primary-button></a>
                                        <x-danger-button onclick="document.getElementById('notification-{{ $attendance->id }}').classList.remove('hidden')">Hapus</x-danger-button>
                                        @else
                                        <a href="{{ route('siswa.edit', $attendance->id) }}"><x-primary-button>Presensi</x-primary-button></a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $no++
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="py-4">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

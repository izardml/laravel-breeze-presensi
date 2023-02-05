<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @php
                $user = Auth::user();
            @endphp
            {{ __('Presensi ' . $attendance->date . ' - ' . $attendance->subject_id) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <section class="mb-4">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __($attendance->topic) }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Tgl. ' . $attendance->date . ' Mapel: ' . $attendance->subject_id) }}
                            </p>
                        </header>
                    </section>

                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full overflow-hidden shadow">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Class</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Kehadiran</th>
                                    <th scope="col" class="px-6 py-3  text-center text-xs font-medium text-gray-800 uppercase tracking-wider">Waktu</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @php
                                    $no = 1 * (isset($_GET['page']) ? $_GET['page'] * 5 - 4 : 1);
                                @endphp
                                @foreach($attdetails as $attdetail)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $no }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attdetail->student_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attendance->class_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attdetail->attstatus }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">{{ $attdetail->created_at }}</td>
                                </tr>
                                @php
                                    $no++
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <x-primary-button onclick="print()">Print</x-primary-button>
                        {{-- Daftar Hadir Siswa class_id Tanggal date - subject_id --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

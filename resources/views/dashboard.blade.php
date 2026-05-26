<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 font-medium text-lg">
                    Halo, selamat datang kembali <strong>{{ Auth::user()->name }}</strong>! 👋
                </div>
            </div>

            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'partner')
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Total Klien</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalClients }}</h3>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Project Aktif</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $activeProjects }}</h3>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Pemasukan Bulan Ini</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">Rp {{ number_format($incomeThisMonth, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Tenggat Waktu Terdekat (Top 5)</h3>
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <th class="py-3 px-4 border-b">Project</th>
                                    <th class="py-3 px-4 border-b">Klien</th>
                                    <th class="py-3 px-4 border-b">Deadline</th>
                                    <th class="py-3 px-4 border-b">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($upcomingDeadlines as $project)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 border-b font-medium text-gray-900">{{ $project->title }}</td>
                                    <td class="py-2 px-4 border-b text-gray-700">{{ $project->client->name }}</td>
                                    <td class="py-2 px-4 border-b text-red-600 font-bold">{{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</td>
                                    <td class="py-2 px-4 border-b">
                                        <span class="px-2 py-1 text-xs font-bold rounded 
                                            {{ $project->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                            {{ $project->status == 'in_progress' ? 'bg-blue-200 text-blue-800' : '' }}
                                            {{ $project->status == 'review' ? 'bg-purple-200 text-purple-800' : '' }}">
                                            {{ strtoupper(str_replace('_', ' ', $project->status)) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-4 px-4 text-center text-gray-500">Belum ada project yang mendesak. Aman terkendali!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if(Auth::user()->role === 'designer')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Tugas Aktif (Belum Selesai)</p>
                        <h3 class="text-3xl font-extrabold text-gray-800">{{ $activeTasks }} Tugas</h3>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-red-500">
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Deadline Terdekat</p>
                        <h3 class="text-xl font-extrabold text-gray-800">
                            {{ $upcomingDeadlines->count() > 0 ? \Carbon\Carbon::parse($upcomingDeadlines->first()->deadline)->format('d F Y') : 'Aman Sentosa, tidak ada tugas!' }}
                        </h3>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        <p class="mb-4 text-gray-600">Cek menu <strong>Tugas Desain</strong> untuk melihat detail brief klien dan memperbarui status pengerjaan desainmu.</p>
                        <a href="{{ route('tasks.index') }}" class="inline-block bg-gray-800 text-white font-bold py-2 px-6 rounded hover:bg-gray-700">Pergi ke Papan Tugas</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
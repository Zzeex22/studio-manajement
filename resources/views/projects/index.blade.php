<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 mb-6">
                        + Tambah Project
                    </a>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b text-left">Nama Project</th>
                                <th class="py-3 px-4 border-b text-left">Klien</th>
                                <th class="py-3 px-4 border-b text-left">Deadline</th>
                                <th class="py-3 px-4 border-b text-left">Status</th>
                                <th class="py-3 px-4 border-b text-center">File Hasil</th>
                                <th class="py-3 px-4 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b font-bold text-gray-900">{{ $project->title }}</td>
                                <td class="py-2 px-4 border-b text-gray-700">{{ $project->client->name }}</td>
                                <td class="py-2 px-4 border-b text-gray-600">{{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</td>
                                <td class="py-2 px-4 border-b">
                                    <span class="px-2 py-1 text-xs font-bold rounded 
                                        {{ $project->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : '' }}
                                        {{ $project->status == 'in_progress' ? 'bg-blue-200 text-blue-800' : '' }}
                                        {{ $project->status == 'review' ? 'bg-purple-200 text-purple-800' : '' }}
                                        {{ $project->status == 'completed' ? 'bg-green-200 text-green-800' : '' }}">
                                        {{ strtoupper(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($project->design_file)
                                        <a href="{{ asset('storage/' . $project->design_file) }}" target="_blank" class="text-xs bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded hover:bg-blue-200 transition">
                                            Lihat File
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400">Belum Ada</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-center space-x-2">
                                    <a href="{{ route('projects.edit', $project->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-bold">Edit</a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold" onclick="return confirm('Yakin menghapus data project ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-500">Belum ada data project yang terdaftar dalam sistem.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
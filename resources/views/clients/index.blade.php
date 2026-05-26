<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Klien') }}
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
                    <a href="{{ route('clients.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 mb-6">
                        + Tambah Klien Baru
                    </a>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b text-left">Nama</th>
                                <th class="py-3 px-4 border-b text-left">Perusahaan / Toko</th>
                                <th class="py-3 px-4 border-b text-left">Email</th>
                                <th class="py-3 px-4 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ $client->name }}</td>
                                <td class="py-2 px-4 border-b">{{ $client->company ?? '-' }}</td>
                                <td class="py-2 px-4 border-b">{{ $client->email }}</td>
                                <td class="py-2 px-4 border-b text-center space-x-2">
                                    <a href="{{ route('clients.edit', $client->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-bold">Edit</a>
                                    
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                                    </form>
                                </td>
                                                                
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-4 px-4 text-center text-gray-500">Belum ada klien. Ayo cari *project* desain logo atau flyer dulu!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
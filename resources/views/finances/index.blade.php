<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Keuangan') }}
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
                    <a href="{{ route('finances.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 mb-6">
                        + Catat Transaksi Baru
                    </a>

                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 border-b text-left">Tanggal</th>
                                <th class="py-3 px-4 border-b text-left">Deskripsi</th>
                                <th class="py-3 px-4 border-b text-left">Terkait Project</th>
                                <th class="py-3 px-4 border-b text-right">Nominal (Rp)</th>
                                <th class="py-3 px-4 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($finances as $finance)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ \Carbon\Carbon::parse($finance->transaction_date)->format('d M Y') }}</td>
                                <td class="py-2 px-4 border-b">
                                    <span class="px-2 py-1 text-xs font-bold rounded mr-2
                                        {{ $finance->transaction_type == 'income' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ $finance->transaction_type == 'income' ? 'MASUK' : 'KELUAR' }}
                                    </span>
                                    {{ $finance->description }}
                                </td>
                                <td class="py-2 px-4 border-b">{{ $finance->project ? $finance->project->title : 'Operasional Umum' }}</td>
                                <td class="py-2 px-4 border-b text-right font-mono {{ $finance->transaction_type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $finance->transaction_type == 'income' ? '+' : '-' }} Rp {{ number_format($finance->amount, 0, ',', '.') }}
                                </td>
                               <td class="py-2 px-4 border-b text-center space-x-2">
                                    <a href="{{ route('finances.edit', $finance->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-bold">Edit</a>

                                        <form action="{{ route('finances.destroy', $finance->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold" onclick="return confirm('Hapus catatan transaksi ini?')">Hapus</button>
                                        </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-4 px-4 text-center text-gray-500">Belum ada catatan transaksi keuangan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
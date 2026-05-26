<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('finances.update', $finance->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4 flex space-x-4">
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jenis Transaksi</label>
                                <select name="transaction_type" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <option value="income" {{ $finance->transaction_type == 'income' ? 'selected' : '' }}>Pemasukan (Income)</option>
                                    <option value="expense" {{ $finance->transaction_type == 'expense' ? 'selected' : '' }}>Pengeluaran (Expense)</option>
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transaksi</label>
                                <input type="date" name="transaction_date" value="{{ $finance->transaction_date }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Terkait Project (Opsional)</label>
                            <select name="project_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">-- Bukan Untuk Project Spesifik (Operasional Umum) --</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ $finance->project_id == $project->id ? 'selected' : '' }}>
                                        {{ $project->title }} (Klien: {{ $project->client->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Keterangan / Deskripsi</label>
                            <input type="text" name="description" value="{{ $finance->description }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nominal (Rp)</label>
                            <input type="number" name="amount" min="0" value="{{ $finance->amount }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('finances.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
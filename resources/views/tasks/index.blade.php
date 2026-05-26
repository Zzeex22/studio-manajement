<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tugas Desain') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($tasks as $task)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 
                        {{ $task->status == 'pending' ? 'border-yellow-400' : '' }}
                        {{ $task->status == 'in_progress' ? 'border-blue-400' : '' }}
                        {{ $task->status == 'review' ? 'border-purple-400' : '' }}">
                        
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $task->title }}</h3>
                            <p class="text-sm text-gray-500 mb-4 font-semibold">Tenggat Waktu: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</p>

                            <div class="bg-gray-50 p-3 rounded text-sm text-gray-700 mb-4 h-28 overflow-y-auto border border-gray-200">
                                <strong class="block mb-1">Brief Klien:</strong>
                                {{ $task->description ?: 'Tidak ada instruksi khusus. Silakan koordinasi dengan Admin.' }}
                            </div>

                            <form action="{{ route('tasks.updateStatus', $task->id) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                @method('PATCH')
                                
                                <div class="mb-4">
                                    <label class="block text-xs font-bold text-gray-700 mb-1">Setor File Hasil (.zip/.png/.jpg)</label>
                                    <input type="file" name="design_file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded">
                                    
                                    @if($task->design_file)
                                        <p class="text-xs text-green-600 mt-1 font-semibold">✓ File desain sudah terkirim ke Admin.</p>
                                    @endif
                                </div>

                                <div class="flex items-center space-x-2">
                                    <select name="status" class="shadow-sm border-gray-300 rounded text-sm w-full focus:ring focus:ring-blue-200 focus:outline-none">
                                        <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                        <option value="review" {{ $task->status == 'review' ? 'selected' : '' }}>Review Klien</option>
                                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded text-sm hover:bg-gray-700 transition font-bold">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-lg shadow-sm border border-gray-200">
                        <p class="text-gray-500 font-medium">Belum ada tugas desain yang aktif saat ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 px-8">
        @if(session('success'))
            <div class="mb-4 max-w-3xl mx-auto bg-green-600 text-white px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- greeting header similar to design --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Dashboard 👋</h1>
            <p class="text-sm text-gray-400">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>

        <!-- summary cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="rounded-lg p-5 text-white bg-gradient-to-r from-indigo-500 to-purple-600">
                <div class="text-xs uppercase">Total Tugas</div>
                <div class="text-3xl font-bold">{{ $total }}</div>
            </div>
            <div class="rounded-lg p-5 text-white bg-gradient-to-r from-green-500 to-green-700">
                <div class="text-xs uppercase">Selesai</div>
                <div class="text-3xl font-bold">{{ $selesai }}</div>
            </div>
            <div class="rounded-lg p-5 text-white bg-gradient-to-r from-yellow-500 to-yellow-700">
                <div class="text-xs uppercase">Belum Selesai</div>
                <div class="text-3xl font-bold">{{ $belum ?? ($total - $selesai) }}</div>
            </div>
            <div class="rounded-lg p-5 text-white bg-gradient-to-r from-red-500 to-red-700">
                <div class="text-xs uppercase">Terlambat</div>
                <div class="text-3xl font-bold">{{ $terlambat ?? 0 }}</div>
            </div>
        </div>

        <!-- action row -->
        <div class="mt-6 flex justify-between items-center">
            <div class="flex space-x-2">
                <input type="text" placeholder="Cari tugas..." class="px-3 py-2 rounded bg-gray-800 text-white focus:outline-none"/>
                <select name="status" onchange="this.form.submit()" class="rounded bg-gray-800 text-white px-3 py-2">
                    <option value="" {{ request('status')==''?'selected':'' }}>Semua</option>
                    <option value="belum" {{ request('status')=='belum'?'selected':'' }}>Belum</option>
                    <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                </select>
            </div>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-purple-600 text-white rounded">+ Tambah Tugas</a>
        </div>

        <!-- task list -->
        <div class="mt-6">
            <div class="space-y-3">
                @foreach($tasks as $task)
                    <div class="bg-gray-800 rounded-lg p-4 text-white flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <input type="checkbox" {{ $task->status=='selesai'?'checked':'' }} disabled class="form-checkbox h-5 w-5 text-green-400" />
                            <div>
                                <h3 class="font-medium">{{ $task->judul }}</h3>
                                <div class="text-xs text-gray-400">{{ $task->deadline->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs px-2 py-1 rounded {{ $task->status=='selesai' ? 'bg-green-500' : 'bg-yellow-500' }}">
                                {{ ucfirst($task->status) }}
                            </span>
                            <a href="{{ route('tasks.edit',$task) }}" class="px-2 py-1 bg-blue-600 rounded text-sm">Edit</a>
                            <form method="POST" action="{{ route('tasks.destroy',$task) }}" onsubmit="return confirm('Hapus tugas?');">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-1 bg-red-600 rounded text-sm">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                @if($tasks->isEmpty())
                    <p class="text-center text-gray-400 mt-6">Tidak ada tugas.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

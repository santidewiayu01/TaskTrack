<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Edit Tugas') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-4 max-w-lg mx-auto">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm text-gray-300">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $task->judul) }}" required
                       class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600" />
                @error('judul')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600">{{ old('deskripsi', $task->deskripsi) }}</textarea>
                @error('deskripsi')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300">Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline', $task->deadline->format('Y-m-d')) }}" required
                       class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600" />
                @error('deadline')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300">Status</label>
                <select name="status" class="w-full mt-1 p-2 rounded bg-gray-700 text-white border border-gray-600">
                    <option value="belum" {{ old('status', $task->status)=='belum'?'selected':'' }}>Belum</option>
                    <option value="selesai" {{ old('status', $task->status)=='selesai'?'selected':'' }}>Selesai</option>
                </select>
                @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded text-white" style="background:#1f2937;border:1px solid #111827;">Batal</a>
                <button type="submit" class="px-4 py-2 rounded text-white" style="background:#111827;border:1px solid #0f172a;">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>

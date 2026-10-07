<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Tambah Tugas') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4 max-w-lg mx-auto">
            @csrf
            <div>
                <label class="block text-sm text-gray-300">Judul</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul tugas"
                       style="width:100%;margin-top:0.25rem;padding:0.5rem;border-radius:0.375rem;background-color:#ffffff;color:#000000;border:1px solid #d1d5db;" />
                @error('judul')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300">Deskripsi</label>
                <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi tugas (opsional)"
                       style="width:100%;margin-top:0.25rem;padding:0.5rem;border-radius:0.375rem;background-color:#ffffff;color:#000000;border:1px solid #d1d5db;font-family:inherit;"></textarea>
                @error('deskripsi')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm text-gray-300">Deadline</label>
                <input type="date" name="deadline" value="{{ old('deadline') }}" required
                       style="width:100%;margin-top:0.25rem;padding:0.5rem;border-radius:0.375rem;background-color:#ffffff;color:#000000;border:1px solid #d1d5db;" />
                @error('deadline')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded text-white" style="background:#1f2937;border:1px solid #111827;">Batal</a>
                <button type="submit" class="px-4 py-2 rounded text-white" style="background:#111827;border:1px solid #0f172a;">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>

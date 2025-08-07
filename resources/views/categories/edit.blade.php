<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-2xl font-medium text-gray-900 dark:text-white">
                        Memperbarui: {{ $category->name }}
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        Ubah detail di bawah ini untuk memperbarui kategori.
                    </p>
                </div>

                <div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 p-6 lg:p-8">
                    {{-- Perhatikan 'action' dan adanya @method('PUT') --}}
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Kategori</label>
                                {{-- Perhatikan 'value' yang sudah diisi data lama --}}
                                <input id="name" type="text" name="name"
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                       value="{{ old('name', $category->name) }}" required autofocus>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="slug" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Slug</label>
                                {{-- Perhatikan 'value' yang sudah diisi data lama --}}
                                <input id="slug" type="text" name="slug"
                                       class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                       value="{{ old('slug', $category->slug) }}" required>
                                {{-- <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Slug akan dibuat otomatis, tapi bisa diubah jika perlu.</p> --}}
                                @error('slug')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                            <a href="{{ route('categories.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mr-4">
                                Batal
                            </a>
                            <button type="submit"
                                    class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Perbarui Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script slug otomatis tetap disertakan --}}
    @push('scripts')
    <script>
        const nameInput = document.querySelector('#name');
        const slugInput = document.querySelector('#slug');

        nameInput.addEventListener('keyup', function() {
            const nameValue = this.value.trim().toLowerCase();
            const slugValue = nameValue.replace(/[^a-z0-9\s-]/g, '')
                                     .replace(/\s+/g, '-')
                                     .replace(/-+/g, '-');
            slugInput.value = slugValue;
        });
    </script>
    @endpush
</x-app-layout>
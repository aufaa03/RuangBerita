<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            {{-- Grup Kiri: Tombol Back dan Judul --}}
            <div class="flex items-center space-x-2">
                {{-- Tombol Back yang sudah diperbaiki --}}
                <a href="{{ route('posts.dashboard.index') }}" 
                   class="p-2 rounded-full text-gray-700 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors duration-200" 
                   title="Kembali ke Manajemen Post">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Manajemen Kategori') }}
                </h2>
            </div>

            {{-- Grup Kanan: Tombol Aksi Utama --}}
            <a href="{{ route('categories.create') }}"
               class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all shadow-md">
                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-200 p-4 mb-6 rounded-md"
                             role="alert">
                            <p class="font-bold">Sukses</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 text-red-700 dark:text-red-200 p-4 mb-6 rounded-md"
                             role="alert">
                            <p class="font-bold">Gagal</p>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Slug</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($categories as $category)
                                    {{-- PERBAIKAN 1: Efek hover yang lebih baik dan kontras --}}
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-150">
                                        {{-- PERBAIKAN 2: Typo & Kontras Teks Nama Kategori --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white dark:text-gray-300">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 font-mono">
                                            {{ $category->slug }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center space-x-4">
                                                <a href="{{ route('categories.edit', $category) }}"
                                                   class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                                   title="Edit">Edit</a>
                                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Aksi ini tidak dapat dibatalkan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            title="Hapus">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada kategori yang ditemukan.
                                            {{-- PERBAIKAN 3: Kontras link di mode gelap --}}
                                            <a href="{{ route('categories.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline ml-2">
                                                Buat Kategori Baru
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($categories->hasPages())
                        <div class="mt-4">
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
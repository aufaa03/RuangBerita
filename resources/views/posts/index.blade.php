<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manajemen Post') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('categories.index') }}"
                   class="flex items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 shadow-sm">
                    Manajemen Kategori
                </a>
                <a href="{{ route('posts.create') }}"
                   class="flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-700 text-white font-bold rounded-lg hover:from-blue-700 hover:to-indigo-800 transition-all shadow-md">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Post Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        {{-- 1. Class max-w-7xl dihapus dari div di bawah ini agar layout menjadi full-width --}}
        <div class="sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8">
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 text-green-700 dark:text-green-200 p-4 mb-6 rounded-md" role="alert">
                            <p class="font-bold">Sukses</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @isset($categories)
                        <form action="{{ route('posts.dashboard.index') }}" method="GET" class="mb-6">
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <div class="flex-grow w-full sm:w-auto">
                                    <input type="text" name="search" placeholder="Cari berdasarkan judul..."
                                           class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                           value="{{ request('search') }}">
                                </div>
                                <div>
                                    <select name="category"
                                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex space-x-2">
                                    {{-- 2. Class untuk tombol Filter diperbaiki agar terlihat di semua mode --}}
                                    <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500 transition-colors duration-200 shadow-sm">
                                        Filter
                                    </button>
                                    <a href="{{ route('posts.dashboard.index') }}"
                                       class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200 shadow-sm">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endisset

                    {{-- 3. Class 'overflow-x-auto' di sini sudah benar untuk mencegah scroll horizontal pada halaman --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 w-full">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            {{-- ... sisa kode tabel Anda (thead, tbody) tetap sama ... --}}
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/3">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($posts as $post)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap w-1/3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $post->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                {{ $post->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $post->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end items-center space-x-4">
                                                <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300" title="Edit">Edit</a>
                                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Hapus">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada post yang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($posts->hasPages())
                        <div class="mt-6">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
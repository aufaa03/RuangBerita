<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Post Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div>
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Judul <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                value="{{ old('title') }}" required autofocus>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" id="category_id"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Gambar
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col w-full cursor-pointer">
                                    <div
                                        class="px-4 py-4 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg">
                                        <div class="flex flex-col items-center justify-center space-y-2">
                                            <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="text-xs text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Klik untuk upload</span> atau drag and drop
                                            </p>
                                            <p class="text-2xs text-gray-400 dark:text-gray-500">PNG, JPG, JPEG (Max.
                                                2MB)</p>
                                        </div>
                                        <input id="image" name="image" type="file" class="hidden" />
                                    </div>
                                </label>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="body"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Isi Post <span class="text-red-500">*</span>
                            </label>
                            <textarea name="body" id="body" rows="10"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">{{ old('body') }}</textarea>
                            @error('body')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end pt-4">
                            <a href="{{ route('posts.dashboard.index') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-white font-medium rounded-lg transition duration-150 ease-in-out">Batal</a>
                            <button type="submit"
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-white font-medium rounded-lg transition duration-150 ease-in-out">
                                Simpan Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Display selected file name for image upload
            document.getElementById('image').addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || 'Belum ada file dipilih';
                const uploadText = document.querySelector('.flex.flex-col.items-center.justify-center p:first-child');
                if (uploadText) {
                    uploadText.textContent = fileName;
                }
            });
        </script>
    @endpush
</x-app-layout>

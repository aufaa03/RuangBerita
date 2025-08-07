<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RuangBerita - Artikel Teknologi & Pengembangan Diri</title>
    <meta name="description" content="Blog pribadi berisi artikel inspiratif seputar teknologi, pemrograman, dan pengembangan diri.">

    @include('profile.partials.head')
   
</head>
<body class="bg-gray-50 antialiased text-gray-800 min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-grow">
        <section class="bg-gradient-to-r from-blue-50 to-indigo-50 py-16">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                   Informasi Terpercaya & Analisis Mendalam
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                 Menjelajahi topik teknologi, wawasan pengembangan diri, dan dinamika global yang relevan untuk Anda.
                </p>
            </div>
        </section>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            @if ($featuredPost)
                <section class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Artikel Utama</h2>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden group">
                        <a href="{{ route('posts.show', $featuredPost) }}" class="block md:flex">
                            @if ($featuredPost->image)
                                <div class="md:w-1/2">
                                    <img src="{{ asset('storage/' . $featuredPost->image) }}" 
                                         alt="{{ $featuredPost->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @endif
                            <div class="p-6 md:p-8 flex flex-col justify-center {{ $featuredPost->image ? 'md:w-1/2' : 'w-full' }}">
                                <div>
                                    <div class="flex items-center space-x-3 mb-3">
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full 
    @if($featuredPost->category->name === 'Teknologi')
        text-primary-600 bg-primary-100
    @elseif($featuredPost->category->name === 'Gaya Hidup')
        text-green-600 bg-green-100
    @elseif($featuredPost->category->name === 'Tutorial Pemrograman')
        text-yellow-600 bg-yellow-100
    @elseif($featuredPost->category->name === 'Berita Terbaru')
        text-red-600 bg-red-100
    @elseif($featuredPost->category->name === 'Pemandangan Alam')
        text-purple-600 bg-purple-100
    @else
        text-gray-600 bg-gray-100
    @endif">
    {{ $featuredPost->category->name }}
</span>
                                        <span class="text-xs text-gray-500">
                                            {{ $featuredPost->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                        {{ $featuredPost->title }}
                                    </h2>
                                    <p class="text-gray-600 mb-4">
                                        {{ Str::limit(strip_tags($featuredPost->body), 200) }}
                                    </p>
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-medium text-sm">
                                            {{ strtoupper(substr($featuredPost->user->name, 0, 1)) }}
                                        </div>
                                        <span class="ml-3 text-sm text-gray-700 font-medium">{{ $featuredPost->user->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </section>
            @endif

            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Artikel Terbaru</h2>
                
                @if($posts->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($posts as $post)
                            <article class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-xl transition-shadow duration-300 flex flex-col">
                                <a href="{{ route('posts.show', $post) }}" class="block">
                                    @if ($post->image)
                                        <div class="h-48 w-full overflow-hidden">
                                            <img src="{{ asset('storage/' . $post->image) }}" 
                                                 alt="{{ $post->title }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        </div>
                                    @endif
                                </a>
                                <div class="p-5 flex flex-col flex-grow">
                                    <div class="flex-grow">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="text-xs font-semibold text-primary-600 bg-primary-100 px-2 py-1 rounded-full">
                                                {{ $post->category->name }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                {{ $post->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                                            <a href="{{ route('posts.show', $post) }}" class="hover:text-primary-600 transition-colors">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 text-sm mb-3">
                                            {{ Str::limit(strip_tags($post->body), 100) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 pt-3 border-t border-gray-100">
                                        <span>Oleh {{ $post->user->name }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="text-center py-16 bg-gray-100 rounded-lg">
                        <i class="fas fa-newspaper text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada artikel</h3>
                        <p class="text-gray-600">Kami akan segera memposting artikel menarik untuk Anda.</p>
                    </div>
                @endif
            </section>
        </div>
    </main>

   {{-- footer --}}
   @include('layouts.footer')

</body>
</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} | Blog Saya</title>

    {{-- <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> --}}
    @include('profile.partials.head')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
        }

        /* Tambahkan ini ke dalam bagian style yang sudah ada */
        .article-content {
            font-size: 1.125rem;
            /* 18px */
            color: #374151;
            line-height: 1.8;
            /* Lebih longgar dari sebelumnya */
            text-rendering: optimizeLegibility;
            /* Untuk rendering teks yang lebih baik */
            font-kerning: normal;
            /* Mengatur spasi antar huruf */
            text-align: justify;
            text-justify: inter-word;
            /* Distribusi spasi yang lebih baik */
            hyphens: auto;
            word-wrap: break-word;
            max-width: 100%;
        }

        /* Pemformatan paragraf profesional */
        .article-content p {
            margin-bottom: 1.75rem;
            text-align: justify;
            text-justify: inter-word;
            hyphenate-limit-chars: 6 3 3;
            /* Minimal 6 karakter, 3 sebelum dan sesudah tanda hubung */
            hyphenate-limit-lines: 2;
            /* Maksimal 2 baris berturut-turut dengan tanda hubung */
            orphans: 3;
            /* Minimal 3 baris di bagian bawah halaman */
            widows: 3;
            /* Minimal 3 baris di bagian atas halaman */
        }

        /* Spasi setelah tanda baca */
        .article-content p:after {
            content: " ";
            display: inline;
        }

        /* Mencegah pemenggalan setelah singkatan */
        .article-content abbr {
            white-space: nowrap;
        }

        /* Kontrol spasi untuk tanda baca */
        .article-content {
            hanging-punctuation: allow-end;
            /* Memungkinkan tanda baca menggantung di margin */
        }

        /* Format khusus untuk elemen teks lainnya */
        .article-content h2,
        .article-content h3,
        .article-content h4 {
            text-align: left;
            text-justify: none;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem; 
            line-height: 1.3;
        }

        /* Format untuk list */
        .article-content ul,
        .article-content ol {
            margin-bottom: 2rem;
            padding-left: 2rem;
        }

        .article-content li {
            margin-bottom: 0.75rem;
            text-align: left;
        }

        /* Format blockquote */
        .article-content blockquote {
            font-style: italic;
            margin: 2rem 0;
            padding: 1rem 1.5rem;
            border-left: 4px solid #3B82F6;
            background-color: #F8FAFC;
            color: #334155;
        }

        /* Responsif untuk mobile */
        @media (max-width: 768px) {
            .article-content {
                font-size: 1rem;
                line-height: 1.7;
                text-align: left;
                text-justify: auto;
            }

            .article-content p {
                text-align: left;
                hyphens: none;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-3xl">
        <article class="bg-white rounded-lg shadow-sm p-6">
            <!-- Post Meta -->
            <div class="mb-6">
                <span
                    class="text-xs font-semibold px-2 py-1 rounded-full
    @if ($post->category->name === 'Teknologi') text-primary-600 bg-primary-100
    @elseif($post->category->name === 'Gaya Hidup')
        text-green-600 bg-green-100
    @elseif($post->category->name === 'Tutorial Pemrograman')
        text-yellow-600 bg-yellow-100
    @elseif($post->category->name === 'Berita Terbaru')
        text-red-600 bg-red-100
    @elseif($post->category->name === 'Pemandangan Alam')
        text-purple-600 bg-purple-100
    @else
        text-gray-600 bg-gray-100 @endif">
                    {{ $post->category->name }}
                </span>

                <h1 class="text-2xl md:text-3xl font-bold mt-2 mb-4">{{ $post->title }}</h1>
                <div class="flex items-center text-sm text-gray-500">
                    <span>Oleh {{ $post->user->name }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $post->created_at->format('d F Y') }}</span>
                    <span class="mx-2">•</span>
                    <span>Diperbarui {{ $post->updated_at->diffForHumans() }}</span>

                </div>
            </div>

            <!-- Featured Image -->
            @if ($post->image)
                <div class="mb-6">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        class="w-full rounded-lg">
                </div>
            @endif

            <!-- Article Content -->
            <div class="article-content text-gray-700">
                {!! $post->body !!}
            </div>

            <!-- Tags -->
            @if ($post->tags && count($post->tags) > 0)
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Tag:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <span class="px-3 py-1 text-sm bg-gray-100 text-gray-600 rounded-full">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </article>

        <!-- Navigation -->
        <div class="mt-8 flex justify-between">
            @if ($previousPost)
                <a href="{{ route('posts.show', $previousPost) }}"
                    class="text-blue-600 hover:underline flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Sebelumnya
                </a>
            @else
                <span></span>
            @endif

            @if ($nextPost)
                <a href="{{ route('posts.show', $nextPost) }}" class="text-blue-600 hover:underline flex items-center">
                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @endif
        </div>

        <!-- Related Posts -->
        @if ($relatedPosts && $relatedPosts->count() > 0)
            <div class="mt-12">
                <h2 class="text-xl font-semibold mb-6">Artikel Terkait</h2>
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach ($relatedPosts as $relatedPost)
                        <article
                            class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <a href="{{ route('posts.show', $relatedPost) }}" class="block">
                                @if ($relatedPost->image)
                                    <img src="{{ asset('storage/' . $relatedPost->image) }}"
                                        alt="{{ $relatedPost->title }}" class="w-full h-48 object-cover">
                                @endif
                                <div class="p-4">
                                    <span
                                        class="text-xs font-medium text-blue-600">{{ $relatedPost->category->name }}</span>
                                    <h3 class="mt-1 font-semibold">{{ $relatedPost->title }}</h3>
                                    <p class="mt-2 text-sm text-gray-500">
                                        {{ $relatedPost->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </main>

    @include('layouts.footer')
</body>

</html>

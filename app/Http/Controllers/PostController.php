<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $postsQuery = Post::with('user', 'category')->latest();
        $featuredPost = $postsQuery->first();
        $posts = $postsQuery->where('id', '!=', $featuredPost->id ?? null)->paginate(6);


        return view('user.home', compact('posts', 'featuredPost'));
    }

   public function dashboardIndex(Request $request)
{
    // 1. Mulai Query (tanpa paginate atau get)
    $query = Post::with('category')->latest();

    // 2. Terapkan semua filter yang mungkin ada ke variabel $query
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('body', 'like', "%{$search}%");
        });
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->input('category'));
    }

    // 3. Panggil paginate() di paling akhir setelah semua filter selesai
    // Hasilnya disimpan di variabel $posts
    $posts = $query->paginate(10)->withQueryString();

    // Variabel lain tetap sama
    $categories = Category::all();
    $totalPosts = Post::count(); // Ini menghitung semua post

    // Kirim hanya variabel $posts yang sudah benar ke view
    return view('posts.index', compact('posts', 'totalPosts', 'categories'));
}

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'body' => 'required',
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['slug'] = Str::slug($attributes['title'], '-') . '-' . Str::random(6);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $attributes['image'] = $imagePath;
        }

        Post::create($attributes);
        return redirect()->route('posts.dashboard.index')->with('success', 'Post berhasil ditambahkan!');
    }

    public function show(Post $post)
    {
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(2)
            ->get();

        $previousPost = Post::where('id', '<', $post->id)
            ->latest('id')
            ->first();

        $nextPost = Post::where('id', '>', $post->id)
            ->oldest('id')
            ->first();

        return view('posts.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost
        ]);
    }

    public function edit(Post $post)
    {
        // $this->authorize('update', $post);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        // $this->authorize('update', $post);

        $attributes = $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'body' => 'required',
        ]);

        $attributes['slug'] = Str::slug($attributes['title'], '-') . '-' . Str::random(6);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('posts', 'public');
            $attributes['image'] = $imagePath;
        }

        $post->update($attributes);
        return redirect()->route('posts.dashboard.index')->with('success', 'Post berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        // $this->authorize('delete', $post);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        return redirect()->route('posts.dashboard.index')->with('success', 'Post berhasil dihapus!');
    }
}

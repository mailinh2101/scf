<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::whereNotNull('published_at')->orderBy('published_at', 'desc')->paginate(6)->withQueryString();
        return view('blog', ['posts' => $posts]);
    }

    public function show(string $slug): View
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $recentPosts = Post::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();
        return view('blog-post', ['post' => $post, 'recentPosts' => $recentPosts]);
    }
}

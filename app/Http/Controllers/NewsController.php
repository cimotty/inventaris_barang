<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view ('news.index');
    }

    public function show(News $post)
    {
        $recentPosts = News::where('id', '!=', $post->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        $formattedDate = Carbon::parse($post->created_at)->translatedFormat('d F Y');

        return view ('news.show', [
            'post' => $post,
            'recentPosts' => $recentPosts,
            'formattedDate' => $formattedDate,
        ]);
    }

    public function posts (News $post)
    {
        $recentPosts = News::where('id', '!=', $post->id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        
        $formattedDate = Carbon::parse($post->created_at)->translatedFormat('d F Y');

        foreach ($recentPosts as $recentPost) {
            $recentPost->formattedDate = Carbon::parse($recentPost->created_at)->translatedFormat('d F Y');
        }

        return view ('news.posts', [
            'post' => $post,
            'recentPosts' => $recentPosts,
            'formattedDate' => $formattedDate,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with(['category', 'tags'])->paginate(6);

        foreach ($posts as $post) {
            if ($post->cover) {
                $post->cover = asset('storage/' . $post->cover);
            } else {
                $post->cover = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
            }
        }

        return response()->json([
            'success' => true,
            'results' => $posts
        ]);
    }

    public function show($id)
    {
        //
    }

}

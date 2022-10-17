<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

use Carbon\Carbon;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::all();
        $yesterday = Carbon::yesterday()->format('Y-m-d h:m:s');
        $recentPosts = Post::where('created_at','>=', $yesterday)->take(10)->get();
        $lastPosts = Post::orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.home', compact('recentPosts', 'lastPosts', 'categories'));
    }
}

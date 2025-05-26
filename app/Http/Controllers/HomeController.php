<?php

namespace App\Http\Controllers;

use App\Models\post\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $totalPosts = Post::withTrashed()->count();
            $totalPendingPosts = Post::where('status', 'pending')->count();
            $totalApprovePosts = Post::where('status', 'approved')->count();
            $totalRejectPosts = Post::where('status', 'rejected')->count();
        } else {
            $totalPosts = Post::where('user_id', auth()->user()->id)->withTrashed()->count();
            $totalPendingPosts = Post::where('user_id', auth()->user()->id)->where('status', 'pending')->count();
            $totalApprovePosts = Post::where('user_id', auth()->user()->id)->where('status', 'approved')->count();
            $totalRejectPosts = Post::where('user_id', auth()->user()->id)->where('status', 'rejected')->count();
        }
        return view('home', compact('totalPosts', 'totalPendingPosts', 'totalApprovePosts','totalRejectPosts'));
    }
}

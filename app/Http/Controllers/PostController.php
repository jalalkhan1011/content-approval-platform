<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\category\Category;
use App\Models\post\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'user') {
            $posts = Post::where('user_id', auth()->user()->id)->withTrashed()->get();
        } elseif (auth()->user()->role == 'admin') {
            $posts = Post::withTrashed()->get();
        }

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::pluck('category_name', 'id')->all();

        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PostService $postService)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|String|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        try {
            $postService->create($request);

            toastr()->success('Post Created Successfully.');
            return redirect(route('post.posts.index'));
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong, Please try again.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('category_name', 'id')->all();
        $selectedCategories = $post->categories->pluck('id')->toArray();
        $tags = $post->tags->pluck('name')->implode(',');

        return view('admin.post.edit', compact('post', 'categories', 'selectedCategories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|String|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        try {
            $data = $request->only('title', 'content');

            //Delete old image if exists
            if ($request->has('image')) {
                if ($post->image) {
                    Storage::delete($post->image);
                }
                if ($post->thumbnail) {
                    Storage::delete($post->thumbnail);
                }

                //Uload new image
                $path = ImageHelper::upload($request->file('image'));
                $data['image'] = $path['image'];
                $data['thumbnail'] = $path['thumbnail'];
            }

            $post->update($data);
            if ($request->has('category_id')) {
                $post->categories()->sync($request->category_id);
            }

            if ($request->filled('tag')) {
                $post->tags()->delete();
                $tags = collect(explode(',', $request->tag))->map(fn($tag) => trim($tag))->filter();

                foreach ($tags as $tag) {
                    $post->tags()->create(['name' => $tag]);
                }
            }
            toastr()->success('Post Update Successfully.');
            return redirect(route('post.posts.index'));
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong, Please try again.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            toastr()->success('Post Deleted Successfully.');
            return redirect(route('post.posts.index'));
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong, Please try again.');
            return back();
        }
    }

    public function approve(Post $post)
    {
        try {
            $post->status = 'approved';
            $post->save();

            // $post->user->notify(new PostStatusNotification($post, 'approved'));
            toastr()->success('Post Approved Successfully.');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong, Please try again.');
            return back();
        }
    }

    public function reject(Post $post)
    {
        try {
            $post->status = 'rejected';
            $post->save();

            // $post->user->notify(new PostStatusNotification($post, 'approved'));
            toastr()->success('Post Rejected Successfully.');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong, Please try again.');
            return back();
        }
    }

    public function restore($id)
    {
        try {
            $post = Post::onlyTrashed()->findOrFail($id);
            $post->restore();
            toastr()->success('Post Restored Successfully.');
            return redirect(route('post.posts.index'));
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong, Please try again.');
            return back();
        }
    }
}

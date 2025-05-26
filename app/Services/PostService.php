<?php

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Models\post\Post;
use Illuminate\Http\Request;

class PostService
{
    public function create(Request $request)
    {
        $data = $request->only('title', 'description');
        $data['user_id'] = auth()->user()->id;

        if ($request->hasFile('image')) {
            $path = ImageHelper::upload($request->file('image'));
            $data['image'] = $path['image'];
            $data['thumbnail'] = $path['thumbnail'];
        }

        $post = Post::create($data);

        if ($request->has('category_id')) {
            $post->categories()->sync($request->category_id);
        }

        if ($request->filled('tag')) {
            $tags = collect(explode(',', $request->tag))->map(fn($tag) => trim($tag))->filter();

            foreach ($tags as $tag) {
                $post->tags()->create(['name' => $tag]);
            }
        }

        return $post;
    }
}

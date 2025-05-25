<?php

namespace App\Http\Controllers;

use App\Models\tag\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        try {
            $data = $request->all();
            Tag::create($data);
            toastr()->success('Tag created successfully');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong. Please try aganin.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        try {
            $data = $request->all();
            $tag->update($data);
            toastr()->success('Tag Updated successfully');
            return redirect(route('tag.tags.index'));
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong. Please try aganin.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            toastr()->success('Tag deleted successfully');
            return back();
        } catch (\Throwable $th) {
            toastr()->error('Something went wrong. Please try aganin.');
            return back();
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models
use App\Models\Post;
use App\Models\Type;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $posts = Post::all();
       return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.posts.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationResult = $request->validate([
            'title' => 'required|max:64',
            'slug' => 'nullable|max:1000',
            'content' => 'nullable|max:1000',
            'type_id' => 'nullable|exists:types,id',
        //   chiavi = name="" degli input 
        ]);

        $post = Post::create($validationResult);

        return redirect()->route('admin.posts.show', ['post' => $post->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $types = Type::all();
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.edit',compact('post', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $validationResult = $request->validate([
            'title' => 'required|max:64',
            'slug' => 'nullable|max:1000',
            'content' => 'nullable|max:1000',
            'type_id' => 'nullable|exists:types,id',
        //   chiavi = name="" degli input 
        ]);

        $post->update($validationResult);

        return redirect()->route('admin.posts.show', ['post' => $post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}

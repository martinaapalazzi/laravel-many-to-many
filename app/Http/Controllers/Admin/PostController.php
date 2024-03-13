<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Helpers
use Illuminate\Support\Facades\Storage;

//Models
use App\Models\Post;
use App\Models\Technology;
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
        $technologies = Technology::all();
        return view('admin.posts.create', compact('types', 'technologies'));
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
            //'technologies' => 'nullable|array|exists:technologies,id',
            'cover_img' => 'nullable|image',
        //  chiavi = name="" degli input 
        ]);

        $imgPath = null;

        if (isset($validationResult['cover_img'])) {
            $imgPath = Storage::disk('public')->put('images', $validationResult['cover_img']);
        }

        $validationResult['cover_img'] = $imgPath;
        $post = Post::create($validationResult);

        if (isset($validationResult['technologies'])) {
            foreach ($validationResult['technologies'] as $singletechnologyId) {

                $post->technologies()->attach($singletechnologyId);
            }
        }

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
        $technologies = Technology::all();
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.edit',compact('post', 'types', 'technologies'));
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
            //'technologies' => 'nullable|array|exists:technologies,id',
            'cover_img' => 'nullable|image',
            'delete_cover_img' => 'nullable|boolean'

        //   chiavi = name="" degli input 
        ]);

        /*
            Per la cover_img, abbiamo 3 possibilità:
            1) Aggiungere una nuova immagine, se prima non ce n'era una                 OK
            2) Rimuovere l'immagine pre-esistente                                       OK
            3) Sostituire l'immagine pre-esistente con una nuova                        OK
                -> Scatenare l'operazione di sostituzione dell'immagine vuol dire che:
                    - Nel form mi è stata passata l'immagine
                    - EEEEE nel $post già ce n'era una
            4) Non fare niente                                                          OK
        */

        $imgPath = $post->cover_img;
        if (isset($validationResult['cover_img'])) {
            if ($post->cover_img != null) {
                Storage::disk('public')->delete($post->cover_img);
            }

            $imgPath = Storage::disk('public')->put('images', $validationResult['cover_img']);
        }
        else if (isset($validationResult['delete_cover_img'])) {
            Storage::disk('public')->delete($post->cover_img);

            $imgPath = null;
        }

        $validationResult['cover_img'] = $imgPath;
        $post->update($validationResult);

        if (isset($validationResult['technologies'])) {
            $post->technologies()->sync($validationResult['technologies']);
        }
        else {
            $post->technologies()->detach();
        };

        return redirect()->route('admin.posts.show', ['post' => $post->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->cover_img != null) {
            Storage::disk('public')->delete($post->cover_img);
        }

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => "nullable|exists:categories,id"
        ]);

        $newPostData = $request->all();
        $newPost = new Post();
        $newPost->fill($newPostData);

        //Non lascio sia generato dal metodo fill così da impedire injections da parte di terzi
        $newPost->user_id = $request->user()->id;

        //Generazione slug
        $slug = Str::slug($newPost->title);
        $slug_url = $slug;

        //Verifico lo slug non esista già in DB
        $post_exists = Post::where('slug', $slug)->first();
        $counter = 1;

        //faccio un ciclo per verificare la presenza di post con $slug uguale
        while ($post_exists) {
            $slug = $slug_url . '-' . $counter;
            $counter++;
            //ripeto la variabile perché adesso ho anche il contatore, oltre allo slug
            $post_exists = Post::where('slug', $slug)->first();
        }

        //Assugno il valore alla mia tabella
        $newPost->slug = $slug;

        $newPost->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        $user = $post->user;
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $data = [
            'post' => $post,
            'categories' => $categories,
            'tags'=> $tags
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => "nullable|exists:categories,id",
            'tags' => "exists:tags,id"
        ]);
        
        $form_data = $request->all();

        // verifico se il titolo ricevuto dal form è diverso dal vecchio titolo
        if ($form_data['title'] != $post->title) {
            //se il titolo è stato modificato dovrò fare altrettando con lo slug v.store()
            $slug = Str::slug($form_data['title']);
            $slug_url = $slug;

            //Verifico lo slug non esista già in DB
            $post_exists = Post::where('slug', $slug)->first();
            $counter = 1;

            //faccio un ciclo per verificare la presenza di post con $slug uguale
            while ($post_exists) {
                $slug = $slug_url . '-' . $counter;
                $counter++;
                //ripeto la variabile perché adesso ho anche il contatore, oltre allo slug
                $post_exists = Post::where('slug', $slug)->first();
            }

            //Assugno il valore alla mia tabella
            $form_data['slug'] = $slug;

        }

        if (!key_exists("tags", $form_data)) {
            $form_data["tags"] = [];
        }

        //$post->tags()->detach();
        //$post->tags()->attach($form_data["tags"]);

        $post->tags()->sync($form_data["tags"]);
        
        $post->update($form_data);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}

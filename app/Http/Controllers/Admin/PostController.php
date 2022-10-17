<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Post;

use Illuminate\Support\Facades\Storage;
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
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $request->validate(
                [
                    'title' => 'required|max:65000|min:3',
                    'content' => 'required|max:65000|min:5',
                    'category_id' => 'nullable|exists:categories,id',
                    'tags' => 'exists:tags,id',
                    'image' => 'nullable|mimes:jpeg,bmp,png,git,svg'
                ],
                [
                    'title.required' => 'Il Titolo del post è richiesto',
                    'title.max' => 'Inserisci deve essere massimo 65k caratteri',
                    'title.min' => 'Il titolo deve essere di almeno 3 caratteri',
                    'content.required' => 'Il Contenuto del post è richiesto',
                    'content.max' => 'Il contenuto del post deve essere massimo 65k caratteri',
                    'content.min' => 'Il contenuto del post deve essere almeno 5 caratteri',
                    'category_id.exists' => 'La categoria non esiste',
                    'tag_id.exists' => 'Il tag non esiste',
                    'image.image' => "L'immagine deve essere in formato jpeg, png, bmp, gif, o svg"
                ]
            );

            $data = $request->all();

            $img_path = Storage::put('cover', $data['image']);

            $data['cover'] = $img_path;

            $newPost = new Post();
            $newSlug = $this->slugGenerator($newPost->title);
            $newPost->slug = $newSlug;
            $newPost->fill($data);
            $newPost->save();

            if (array_key_exists('tags', $data)) {
                $newPost->tags()->sync($data['tags']);
            }

            return redirect()->route('admin.posts.index')->with('status', 'Post creato correttamente!');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

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
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
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
        $request->validate(
            array(
                'title' => 'required|max:65000|min:3',
                'content' => 'required|max:65000|min:5',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'exists:tags,id',
                'image' => 'nullable|mimes:jpeg,bmp,png,git,svg'
            ),
            [
                'title.required' => 'Il Titolo del post è richiesto',
                'title.max' => 'Inserisci deve essere massimo 65k caratteri',
                'title.min' => 'Il titolo deve essere di almeno 3 caratteri',
                'content.required' => 'Il Contenuto del post è richiesto',
                'content.max' => 'Il contenuto del post deve essere massimo 65k caratteri',
                'content.min' => 'Il contenuto del post deve essere almeno 5 caratteri',
                'category_id.exists' => 'La categoria non esiste',
                'tag_id.exists' => 'Il tag non esiste',
                'image.mimes' => "L'immagine deve essere in formato jpeg, png, bmp, gif, o svg"
            ]
        );

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }
            $img_path = Storage::put('cover', $data['image']);
            $data['cover'] = $img_path;
        }

        if (!$post->title == $data['title']) {
            $data['slug'] = $this->slugGenerator($data['title']);
        }

        $post->update($data);

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach([]);
        }

        return redirect()->route('admin.posts.index')->with('status', 'Post modificato correttamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post){

        if ($post->cover) {
            Storage::delete($post->cover);
        }

        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Elemento Cancellato');
    }

    //Funzione generazione Slug
    protected function slugGenerator($postTitle)
    {
        $newSlug = Str::slug($postTitle, '-');
        $control = Post::where('slug', $newSlug)->first();
        $i = 1;

        while($control) {
            $newSlug = Str::slug($postTitle . '-' . $i, '-');
            $i++;
            $control = Post::where('slug', $newSlug)->first();
        }
        return $newSlug;
    }

    // Cancella immagine copertina
    public function deleteCover(Post $post) {

        if ($post->cover) {
            Storage::delete($post->cover);
        }

        $post->cover = null;
        $post->save();

        return redirect()->route('admin.posts.edit', [ 'post' => $post->id])->with('status', 'Immagine cancellata con successo');

    }

}
